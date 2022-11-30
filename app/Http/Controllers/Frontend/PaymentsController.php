<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPaymentRequest;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Event;
use App\Models\EventBooking;
use App\Models\Invoices;
use App\Models\Payment;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class PaymentsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('payment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payments = Payment::with(['payment_event', 'payment_user', 'payment_booking'])->get();

        return view('frontend.payments.index', compact('payments'));
    }
    public function trip_balance_payment(Payment $payment,Request $request){
        $paymentMethod=$request->payment_method;
        $amount_to_paid=(float)$request->pay_amount;
        $paid=(float)$payment->amount_paid+$amount_to_paid;
        $balance=(float)$payment->amount_balance-$amount_to_paid;
        $user=Auth::user();
        try {
            $paymentMethod = $user->findPaymentMethod($paymentMethod);
        }catch (\Exception $exception){
            $user->addPaymentMethod($paymentMethod);
        }

        try {
            $user->createOrGetStripeCustomer();
            $stripe_payment= $user->charge(($amount_to_paid*100), $paymentMethod);
        } catch (\Exception $exception) {
            //   return back()->with('error', );
//            echo $exception->getMessage();
            Session::flash('error',$exception->getMessage());
            return redirect()->back()->with('error',$exception->getMessage());
            exit;
        }
        $payment->update([
            'amount_paid'=>$paid,
            'amount_balance'=>$balance,
        ]);
        Invoices::create([
            'payment_id'=>$payment->id,
            'amount_total'=>$payment->amount_total,
            'amount_paid'=>$paid,
            'payment_done'=>$amount_to_paid,
            'payment_method'=>'CC',
            'payment_details'=>json_encode($stripe_payment),
            'deposit'=>$payment->deposit,
            'installment'=>$payment->installment,
            'total_installments'=>$payment->total_installments,
            'amount_balance'=>$balance,
        ]);
        return redirect()->route('frontend.account.index',['tab'=>'payment'])->with('message','Payment Successful');
    }
    public function create()
    {
        abort_if(Gate::denies('payment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payment_events = Event::pluck('event_title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_bookings = EventBooking::pluck('booking_total', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.payments.create', compact('payment_bookings', 'payment_events', 'payment_users'));
    }

    public function store(StorePaymentRequest $request)
    {
        $payment = Payment::create($request->all());

        return redirect()->route('frontend.payments.index');
    }

    public function edit(Payment $payment)
    {
        abort_if(Gate::denies('payment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payment_events = Event::pluck('event_title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_bookings = EventBooking::pluck('booking_total', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment->load('payment_event', 'payment_user', 'payment_booking');

        return view('frontend.payments.edit', compact('payment', 'payment_bookings', 'payment_events', 'payment_users'));
    }

    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        $payment->update($request->all());

        return redirect()->route('frontend.payments.index');
    }

    public function show(Payment $payment)
    {
//        abort_if(Gate::denies('payment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payment->load('payment_event', 'payment_user', 'payment_booking');
        $data['payment']=$payment;
        $data['booking']=$payment->payment_booking;
//dd($data);
        return view('front.account.invoice', $data);
    }
    public function invoice(Invoices $invoice)
    {
//        abort_if(Gate::denies('payment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $payment=$invoice->payment;
        $payment->load('payment_event', 'payment_user', 'payment_booking');
        $data['payment']=$payment;
        $data['invoice']=$invoice;
        $data['booking']=$payment->payment_booking;
//dd($data);
        return view('front.account.invoice', $data);
    }

    public function destroy(Payment $payment)
    {
        abort_if(Gate::denies('payment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payment->delete();

        return back();
    }

    public function massDestroy(MassDestroyPaymentRequest $request)
    {
        Payment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
