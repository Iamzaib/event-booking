@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            Add Rooms Prices for {{$trip->event_title}}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.events.room_pricing_update', ['trip'=>$trip->id,'action'=>'update']) }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <div class="row mb-2">
                        <div class="col-8">
                            <h3 class="font-weight-bolder">Room Price Based on Date and Capacity</h3>
                        </div>
                        <div class="col-2 text-end">
                            <span class="btn btn-info" onclick="add_new_daterange()">Add New Price Range</span>
                        </div>
                        <div class="col-2 text-center">
                            <button type="submit" class="btn btn-danger" >Save</button>
                        </div>
                    </div>
{{--                    <div class="card p-3">--}}
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
                        @if(count($trip->room_pricing)>0)
                            @foreach($trip->room_pricing as $pricing_range)
                                <input type="hidden" name="range_id[]" value="{{$pricing_range->id}}">
                        <div id="Datarange{{$loop->index}}" class="card p-3">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <strong>
                                        Price Date Range <span>{{$loop->index+1}}</span>
                                    </strong>
                                </div>
                                <div class="col-3">
                                    Start Date
                                </div>
                                <div class="col-3">
                                    <input type="date" name="room_range_start[]" id="" value="{{date('Y-m-d',strtotime($pricing_range->start_date))}}" class="form-control" required>
                                </div>
                                <div class="col-3">
                                    End date
                                </div>
                                <div class="col-3">
                                    <input type="date" name="room_range_end[]" id="" value="{{date('Y-m-d',strtotime($pricing_range->end_date))}}" class="form-control" required>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-6 mt-2">
                                    Price for no Accommodation per person
                                </div>
                                <div class="col-6 mt-2">
                                    <input type="number" step="0.01" name="no_accommodation_room_price[]" value="{{$pricing_range->no_accommodation}}" id="" class="form-control" required>
                                </div>
                                <div class="col-12 mt-2 p-4">
                                    <div class="card p-1 pb-3">
                                    <div class="row">
                                        <div class="card-header col-12">
                                            <strong>Prices For This Range</strong>
                                        </div>

                                        <div class="col-12 mt-3">
                                            <div class="card-body">
                                            @foreach($rooms as $room)
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h3 class="font-weight-bolder">Room: {{$room->room_title}}</h3>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    @for($rc=($room->room_capacity>3?3:1);$rc<=$room->room_capacity;$rc++)

                                                    @php $this_room_pricing=$pricing_range->room_pricing()->where(['room_id'=>$room->id,'for_travelers'=>$rc])->first()// as $this_room_pricing @endphp
                                                    @if(isset($this_room_pricing->id))
                                                        <input type="hidden" name="room_price_id[]" value="{{$this_room_pricing->id}}">
                                                        <div class="col-3 mt-2">
                                                            Price Per Person For {{$this_room_pricing->for_travelers}} Traveler(s)
                                                        </div>
                                                        <div class="col-3 mt-2">
                                                            <input type="number" step="0.01" name="room_price_{{$room->id}}[{{$this_room_pricing->for_travelers}}][{{$this_room_pricing->id}}]" value="{{$this_room_pricing->price}}" id="" class="form-control" required>
                                                        </div>
                                                        @else
                                                            <div class="col-3 mt-2">
                                                                Price Per Person For {{$rc}} Traveler(s)
                                                            </div>
                                                            <div class="col-3 mt-2">
                                                                <input type="number" step="0.01" name="room_price_{{$room->id}}[{{$rc}}][]" id="" class="form-control" required>
                                                            </div>
                                                        @endif
{{--                                                    @endforeach--}}
                                                    @endfor
                                                </div>
                                               @if(!$loop->last)
                                                   <hr>
                                               @endif
                                            @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                            @endforeach
                            <div id="already_exist">


                        @endif

                            <div id="Datarange0" class="blank_daterange card p-3">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <strong>
                                        Price Date Range <span>1</span>
                                    </strong>
                                </div>
                                <div class="col-3">
                                    Start Date
                                </div>
                                <div class="col-3">
                                    <input type="date" name="room_range_start[]" id="" class="form-control" required>
                                </div>
                                <div class="col-3">
                                    End date
                                </div>
                                <div class="col-3">
                                    <input type="date" name="room_range_end[]" id="" class="form-control" required>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-6 mt-2">
                                    Price for no Accommodation per person
                                </div>
                                <div class="col-6 mt-2">
                                    <input type="number" step="0.01" name="no_accommodation_room_price[]" id="" class="form-control" required>
                                </div>
                                <div class="col-12 mt-2 p-4">
                                    <div class="card p-1 pb-3">
                                    <div class="row">
                                        <div class="card-header col-12">
                                            <strong>Prices For This Range</strong>
                                        </div>

                                        <div class="col-12 mt-3">
                                            <div class="card-body">
                                            @foreach($rooms as $room)
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h3 class="font-weight-bolder">Room: {{$room->room_title}}</h3>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    @for($rc=($room->room_capacity>3?3:1);$rc<=$room->room_capacity;$rc++)

                                                        <div class="col-3 mt-2">
                                                            Price Per Person For {{$rc}} Traveler(s)
                                                        </div>
                                                        <div class="col-3 mt-2">
                                                            <input type="number" step="0.01" name="room_price_{{$room->id}}[{{$rc}}][]" id="" class="form-control" required>
                                                        </div>

                                                    @endfor
                                                </div>
                                               @if(!$loop->last)
                                                   <hr>
                                               @endif
                                            @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                                @if(count($trip->room_pricing)>0)
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
        var date_ranges_count= {{count($trip->room_pricing)>0?count($trip->room_pricing)+1:1}};
        $(function (){
            @if(count($trip->room_pricing)>0)
                date_ranges_html=$('.blank_daterange').html();
                $('.blank_daterange').remove();
                @else
                    date_ranges_html=$('#Datarange0').html();
             @endif

        });
        function add_new_daterange(){
            var dr='<div id="Datarange'+(date_ranges_count)+'" class="card p-3">'+date_ranges_html.replace('<span>1</span>','<span>'+(date_ranges_count+1)+'</span>')
                +'<div class="row"><div class="col-12"><span class="btn btn-danger" onclick="remove_date_range('+date_ranges_count+')">&times; Remove this Range</span></div><div>'
                +'</div>';

            @if(count($trip->room_pricing)>0)  $('#price-ranges').prepend(dr);  @else $('#price-ranges').append(dr); @endif
            date_ranges_count++;
        }
        function remove_date_range(count){
            $('#Datarange'+count).remove();
        }
    </script>
@endsection
