@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            Add Installment Options for {{$trip->event_title}}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.events.installment_pricing_update', ['trip'=>$trip->id,'action'=>'update']) }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <div class="row mb-2">
                        <div class="col-6">
                            <h3 class="font-weight-bolder">Installments Options</h3>
                        </div>
                        <div class="col-4 text-end">
                            <span class="btn btn-info" onclick="add_new_daterange()">Add New Installment</span>
                        </div>
                        <div class="col-2 text-center">
                            <button type="submit" class="btn btn-danger" >Save</button>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-2">
                            <h5 class="font-weight-bolder">Deposit (in %)</h5>
                        </div>
                        <div class="col-8 text-end">
                            <input type="number" step="0.01" max="100" name="deposit" value="{{$trip->deposit??''}}" id="" class="form-control" required>
                        </div>
                    </div>

`{{--                    <div class="card p-3">--}}
{{--                        <div class="row mb-2">--}}
{{--                            <div class="col-2  mt-2">--}}
{{--                                <strong>Rooms</strong>--}}
{{--                            </div>--}}
{{--                            <div class="col-8  mt-2">--}}
{{--                                <Select class="select2 form-control" name="rooms" multiple >--}}
{{--                                    @foreach(\App\Models\HotelRoom::all() as $rooms)--}}
{{--                                        @if($rooms->id==3) @continue @endif--}}
{{--                                        <option value="{{$rooms->id}}">{{$rooms->room_title}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </Select>--}}

{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div id="price-ranges">

                        @if(count($trip->installment_options)>0)
                            @foreach($trip->installment_options()->orderBy('installment_no','asc')->get() as $installment_option)

{{--                                <input type="hidden" name="installment_no[]" value="{{$installment_option->installment_no}}">--}}
                            @php $no_[]=$installment_option->installment_no; @endphp
                          <div id="Datarange{{$installment_option->installment_no}}"  class=" card p-3">
                              <input type="hidden" name="installment_id[]" value="{{$installment_option->id}}">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <strong>
                                        Installment <span>{{$installment_option->installment_no}}</span>
                                    </strong>
                                </div>
                                <div class="col-2">
                                    Installment No.
                                </div>
                                <div class="col-2">
                                    <input type="number" step="1" name="installment_no[]" id="" value="{{$installment_option->installment_no}}" class="form-control" required>
                                </div>
                                <div class="col-1">
                                    Due date
                                </div>
                                <div class="col-2">
                                    <input type="date" name="installment_due[]" id="" value="{{date('Y-m-d',strtotime($installment_option->due_date))}}" class="form-control" required>
                                </div>
                                <div class="col-2">
                                    Installment (in %)
                                </div>
                                <div class="col-3">
                                    <input type="number" step="0.01" name="installment[]" id="" value="{{$installment_option->installment}}" class="form-control" required>
                                </div>
                            </div>
                              <div class="row"><div class="col-12"><span class="btn btn-danger" onclick="remove_date_range({{$installment_option->installment_no}})">× Remove this Installment</span></div><div></div></div>

                        </div>
                            @endforeach
                            <div id="already_exist">

                                <input type="hidden" name="installment_nos" value="{{max($no_)}}">
                                @endif
                          <div id="Datarange0" class="blank_daterange card p-3">
                              <input type="hidden" name="installment_id[]" value="0">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <strong>
                                        Installment
                                    </strong>
                                </div>
                                <div class="col-2">
                                    Installment No.
                                </div>
                                <div class="col-2">
                                    <input type="number" step="1" name="installment_no[]" id="" value="" class="form-control" required>
                                </div>
                                <div class="col-1">
                                    Due date
                                </div>
                                <div class="col-2">
                                    <input type="date" name="installment_due[]" id="" class="form-control" required>
                                </div>
                                <div class="col-2">
                                    Installment (in %)
                                </div>
                                <div class="col-3">
                                    <input type="number" step="0.01" name="installment[]" id="" class="form-control" required>
                                </div>
                            </div>

                        </div>
                                @if(count($trip->installment_options)>0)
                            </div>
                        @endif
                    </div>

                </div>
            </form>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        var date_ranges_html='';
        var date_ranges_count= {{count($trip->installment_options)>0?max($no_):1}};
        $(function (){
            @if(count($trip->installment_options)>0)
                date_ranges_html=$('.blank_daterange').html();
                $('.blank_daterange').remove();
                @else
                    date_ranges_html=$('#Datarange0').html();
             @endif

        });//.replace('<span>1</span>','<span>'+(date_ranges_count+1)+'</span>')
        function add_new_daterange(){
            var dr='<div id="Datarange'+(date_ranges_count)+'" class="card p-3">'+date_ranges_html
                +'<div class="row"><div class="col-12"><span class="btn btn-danger" onclick="remove_date_range('+date_ranges_count+')">&times; Remove this Installment</span></div><div>'
                +'</div>';
            // $('#price-ranges').append(dr);
            @if(count($trip->installment_options)>0)  $('#price-ranges').prepend(dr);  @else $('#price-ranges').append(dr); @endif
            date_ranges_count++;
        }
        function remove_date_range(count){
            $('#Datarange'+count).remove();
        }
    </script>
@endsection
