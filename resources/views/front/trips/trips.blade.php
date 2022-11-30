@extends('layouts.front')
@section('content')
    <div class="alltrips">
        <div class="container">
            <h2>All Trips</h2>
        </div>

        <div class="container margin_60_35" style="transform: none;">
            <div class="row" style="transform: none;">
                <!-- /aside -->

                <div class="col-lg-12" id="list_sidebar">

                    <div class="topfilter">
                        <div>
                            <span>Results</span> <span><b id="total_events">0</b></span>
                        </div>
                        <div class="flex2trumj">
                            <div class="prel">
                                <form action="{{route('trips')}}" method="get">
                                    <select class="form-select" name="sort" onchange="sort_trips(this.value)">
                                        <option value="Recent" {{request()->sort=='Recent'?'selected':''}}>Recent</option>
                                        <option value="Cheapest" {{request()->sort=='Cheapest'?'selected':''}}>Cheapest</option>
                                        <option value="expensive" {{request()->sort=='expensive'?'selected':''}}>The most expensive</option>
                                    </select>
                                </form>
                            </div>
{{--                            <div class="grid-sort-icon"><svg width="18" height="18" stroke="#1B3960" stroke-width="2"--}}
{{--                                                             stroke-linecap="round" stroke-linejoin="round">--}}
{{--                                    <path d="M11 1h6v6h-6zm0 10h6v6h-6zM1 1h6v6H1zm0 10h6v6H1z" fill="none" stroke="stroke"></path>--}}
{{--                                </svg></div>--}}
{{--                            <div class="list-sort-icon"><svg width="18" height="18" stroke="#ff027c" stroke-width="2"--}}
{{--                                                             stroke-linecap="round" stroke-linejoin="round">--}}
{{--                                    <path d="M1 1h6v6H1V1zm0 9h6v6H1v-6zm10-6h7m-7 9h7" fill="none" stroke="stroke"></path>--}}
{{--                                </svg></div>--}}
                        </div>
                    </div>


                    <div class="wraperlistrips" id="trips">
                        {{--
                        @foreach($trips as $trip)
                            <div class="listrips">
                            <div class="box_grid">
                                <figure>

                                    <a href="{{route('frontend.trip_view',['trip_title'=>$trip->event_title,'event'=>$trip->id])}}">
                                        <img src="{{ $trip->featured_image->getUrl()??asset('assets/front/img/tour_1.jpg')}}" class="img-fluid" alt="" width="800"
                                                                    height="533"></a>
                                    <small>You save $67</small>
                                </figure>
                            </div>
                            <div class="listguyb4">
                                <small>{{$trip->city->city_name}}, {{$trip->country->name}}</small>
                                <h2>{{$trip->event_title}}</h2>
                                <div class="listrippriceinclude">
                                    <span>the price includes:</span>
                                    <div class="benefit-icon-box d-flex">
                                        @foreach($trip->amenities_includeds as $amenities_included)
                                            @if($amenities_included->icon)
                                                <div class="benefit-icon">
                                                    <div title="{{$amenities_included->title}}"><img src="{{$amenities_included->icon->getUrl()}}" alt=""></div>
                                                </div>
                                            @endif
                                        @endforeach

                                    </div>
                                </div>
                                <div class="listripbotm" style="position: relative;">
                                    <div class="row">
                                        <div class="col-md-8 col-8">
                                            <span class="sdghhhhh colorli">{{$trip->event_start.' - '.$trip->event_end}}</span>
                                        </div>
                                        <div class="col-md-4 col-4" style="padding: 0px;">
                                            <div class="mavUYJ" style="bottom: unset;">
                                                <small class="price colorli">Price per person from</small>
                                                <div class="pricehp mbgu6">

                                                    <small>{{display_currency($trip->daily_price)}}</small>
                                                    <h4>{{display_currency($trip->daily_price)}}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="gobtnbyug">
                                    <a href="{{route('frontend.trip_view',['trip_title'=>$trip->event_title,'event'=>$trip->id])}}" class="btn_1 btngrad">Watch the trip</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        --}}
                      {{--  <div class="listrips">
                            <div class="box_grid">
                                <figure>

                                    <a href="tour-detail.html"><img src="img/tour_2.jpg" class="img-fluid" alt="" width="800"
                                                                    height="533"></a>
                                    <small>You save $ 67</small>
                                </figure>
                            </div>
                            <div class="listguyb4">
                                <small>Zakynthos, Greece</small>
                                <h2>Arc Triomphe</h2>
                                <div class="listrippriceinclude">
                                    <span>the price includes:</span>
                                    <div class="benefit-icon-box d-flex">
                                        <div class="benefit-icon">
                                            <div title="Accommodation in hotel &quot;Koukounaria 4 *&quot;"><svg class="" width="18"
                                                                                                                 height="18" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg"
                                                                                                                 style="display: inline-block; vertical-align: middle;">
                                                    <path
                                                        d="M933.647 903.529h-60.235v-542.118c0-102.4-78.306-180.706-180.706-180.706h-361.412c-102.4 0-180.706 78.306-180.706 180.706v542.118h-60.235c-36.141 0-60.235 24.094-60.235 60.235s24.094 60.235 60.235 60.235h843.294c36.141 0 60.235-24.094 60.235-60.235s-24.094-60.235-60.235-60.235zM752.941 903.529h-180.706v-60.235c0-36.141-24.094-60.235-60.235-60.235s-60.235 24.094-60.235 60.235v60.235h-180.706v-542.118c0-36.141 24.094-60.235 60.235-60.235h361.412c36.141 0 60.235 24.094 60.235 60.235v542.118z"
                                                        style="fill: rgb(156, 169, 186);"></path>
                                                    <path
                                                        d="M331.294 120.471h361.412c36.141 0 60.235-24.094 60.235-60.235s-24.094-60.235-60.235-60.235h-361.412c-36.141 0-60.235 24.094-60.235 60.235s24.094 60.235 60.235 60.235z"
                                                        style="fill: rgb(156, 169, 186);"></path>
                                                </svg></div>
                                        </div>

                                        <div class="benefit-icon">
                                            <div title="Small handbag size 1 pc.  luggage, per person (40 x 30 x 20 cm)"><svg class=""
                                                                                                                              width="18" height="18" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg"
                                                                                                                              style="display: inline-block; vertical-align: middle;">
                                                    <path
                                                        d="M905.846 315.077h-118.154v-98.462c0-98.462-70.892-177.231-157.538-177.231h-236.308c-86.646 0-157.538 78.769-157.538 177.231v98.462h-118.154c-66.954 0-118.154 51.2-118.154 118.154v433.231c0 66.954 51.2 118.154 118.154 118.154h787.692c66.954 0 118.154-51.2 118.154-118.154v-433.231c0-66.954-51.2-118.154-118.154-118.154zM393.846 118.154h236.308c43.323 0 78.769 43.323 78.769 98.462v98.462h-393.846v-98.462c0-55.138 35.446-98.462 78.769-98.462zM315.077 393.846h393.846v512h-393.846v-512zM78.769 866.462v-433.231c0-23.631 15.754-39.385 39.385-39.385h118.154v512h-118.154c-23.631 0-39.385-15.754-39.385-39.385zM945.231 866.462c0 23.631-15.754 39.385-39.385 39.385h-118.154v-512h118.154c23.631 0 39.385 15.754 39.385 39.385v433.231z"
                                                        style="fill: rgb(156, 169, 186);"></path>
                                                </svg></div>
                                        </div>
                                        <div class="benefit-icon">
                                            <div title="Document management"><svg class="" width="18" height="18" viewBox="0 0 1024 1024"
                                                                                  xmlns="http://www.w3.org/2000/svg" style="display: inline-block; vertical-align: middle;">
                                                    <path
                                                        d="M810.667 426.667h-170.667c-25.6 0-42.667 17.067-42.667 42.667s17.067 42.667 42.667 42.667h170.667c25.6 0 42.667-17.067 42.667-42.667s-17.067-42.667-42.667-42.667z"
                                                        style="fill: rgb(156, 169, 186);"></path>
                                                    <path
                                                        d="M810.667 597.333h-170.667c-25.6 0-42.667 17.067-42.667 42.667s17.067 42.667 42.667 42.667h170.667c25.6 0 42.667-17.067 42.667-42.667s-17.067-42.667-42.667-42.667z"
                                                        style="fill: rgb(156, 169, 186);"></path>
                                                    <path
                                                        d="M896 85.333h-128v42.667c0 25.6-17.067 42.667-42.667 42.667s-42.667-17.067-42.667-42.667v-42.667h-341.333v42.667c0 25.6-17.067 42.667-42.667 42.667s-42.667-17.067-42.667-42.667v-42.667h-128c-72.533 0-128 55.467-128 128v597.333c0 72.533 55.467 128 128 128h768c72.533 0 128-55.467 128-128v-597.333c0-72.533-55.467-128-128-128zM938.667 810.667c0 25.6-17.067 42.667-42.667 42.667h-768c-25.6 0-42.667-17.067-42.667-42.667v-597.333c0-25.6 17.067-42.667 42.667-42.667h51.2c17.067 51.2 64 85.333 119.467 85.333s102.4-34.133 119.467-85.333h183.467c17.067 51.2 64 85.333 119.467 85.333s102.4-34.133 119.467-85.333h55.467c25.6 0 42.667 17.067 42.667 42.667v597.333z"
                                                        style="fill: rgb(156, 169, 186);"></path>
                                                    <path
                                                        d="M170.667 725.333h341.333v-341.333h-341.333v341.333zM256 469.333h170.667v170.667h-170.667v-170.667z"
                                                        style="fill: rgb(156, 169, 186);"></path>
                                                </svg></div>
                                        </div>
                                        <div class="benefit-icon">
                                            <div title="Meal type: breakfast and dinner"><svg class="" width="18" height="18"
                                                                                              viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg"
                                                                                              style="display: inline-block; vertical-align: middle;">
                                                    <path
                                                        d="M963.765 1024c-36.141 0-60.235-24.094-60.235-60.235v-222.871h-114.447c-54.212 0-102.4-24.094-138.541-66.259s-48.188-96.376-42.165-150.588l18.071-222.871c18.071-174.682 150.588-301.176 313.224-301.176h24.094c36.141 0 60.235 24.094 60.235 60.235v903.529c0 36.141-24.094 60.235-60.235 60.235zM903.529 126.494c-84.329 18.071-150.588 90.353-156.612 186.729l-24.094 216.847c0 24.094 6.024 48.188 18.071 66.259 12.047 12.047 30.118 24.094 48.188 24.094h114.447v-493.929zM240.941 1024c-36.141 0-60.235-24.094-60.235-60.235v-421.647c-102.4-12.047-180.706-96.376-180.706-198.776v-283.106c0-36.141 24.094-60.235 60.235-60.235s60.235 24.094 60.235 60.235v283.106c0 36.141 24.094 66.259 60.235 78.306v-361.412c0-36.141 24.094-60.235 60.235-60.235s60.235 24.094 60.235 60.235v361.412c36.141-6.024 60.235-42.165 60.235-78.306v-283.106c0-36.141 24.094-60.235 60.235-60.235s60.235 24.094 60.235 60.235v283.106c0 102.4-78.306 186.729-180.706 198.776v421.647c0 30.118-24.094 60.235-60.235 60.235z"
                                                        style="fill: rgb(156, 169, 186);"></path>
                                                </svg></div>
                                        </div>
                                        <div class="benefit-icon">
                                            <div title="Transportation: airport - hotel - airport"><svg class="" width="18" height="18"
                                                                                                        viewBox="0 0 1463 1024" xmlns="http://www.w3.org/2000/svg"
                                                                                                        style="display: inline-block; vertical-align: middle;">
                                                    <path
                                                        d="M1280 343.771l-131.657-21.943c-36.571-7.314-43.886-7.314-58.514-43.886-14.629-29.257-36.571-58.514-73.143-102.4l-73.143-73.143c-73.143-65.829-160.914-102.4-263.314-102.4v0h-241.371c-117.029 0-226.743 51.2-292.571 146.286l-102.4 138.971c-29.257 36.571-43.886 80.457-43.886 131.657v387.657c0 124.343 95.086 219.429 219.429 219.429 95.086 0 175.543-58.514 204.8-146.286h394.971c29.257 87.771 109.714 146.286 204.8 146.286s175.543-58.514 204.8-146.286h160.914c43.886 0 73.143-29.257 73.143-73.143v-241.371c0-109.714-80.457-197.486-182.857-219.429zM219.429 877.714c-43.886 0-73.143-29.257-73.143-73.143s29.257-73.143 73.143-73.143 73.143 29.257 73.143 73.143-29.257 73.143-73.143 73.143zM1024 877.714c-43.886 0-73.143-29.257-73.143-73.143s29.257-73.143 73.143-73.143 73.143 29.257 73.143 73.143-29.257 73.143-73.143 73.143zM1316.571 731.429h-87.771c-29.257-87.771-109.714-146.286-204.8-146.286s-175.543 58.514-204.8 146.286h-394.971c-29.257-87.771-109.714-146.286-204.8-146.286-29.257 0-51.2 7.314-73.143 14.629v-182.857c0-14.629 7.314-29.257 14.629-43.886l102.4-138.971c43.886-58.514 109.714-87.771 175.543-87.771h241.371c58.514 0 117.029 21.943 153.6 65.829l73.143 73.143c21.943 21.943 36.571 43.886 51.2 65.829 29.257 51.2 58.514 102.4 160.914 117.029l131.657 21.943c36.571 7.314 58.514 36.571 58.514 73.143v168.229h7.314z"
                                                        style="fill: rgb(156, 169, 186);"></path>
                                                </svg></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="listripbotm" style="position: relative;">
                                    <div class="row">
                                        <div class="col-md-8 col-8">
                                            <span class="sdghhhhh colorli">08 08 08 - 15 08 2021</span>
                                        </div>
                                        <div class="col-md-4 col-4" style="padding: 0px;">
                                            <div class="mavUYJ" style="bottom: unset;">
                                                <small class="price colorli">Price per person from</small>
                                                <div class="pricehp mbgu6">
                                                    <small>$929</small>
                                                    <h4>$451</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="gobtnbyug">
                                    <a href="./tour-detail.html" class="btn_1 btngrad">Watch the trip</a>
                                </div>
                            </div>
                        </div>

                        <div class="listrips">
                            <div class="box_grid">
                                <figure>

                                    <a href="tour-detail.html"><img src="img/tour_3.jpg" class="img-fluid" alt="" width="800"
                                                                    height="533"></a>
                                    <small>You save $ 67</small>
                                </figure>
                            </div>
                            <div class="listguyb4">
                                <small>Zakynthos, Greece</small>
                                <h2>Arc Triomphe</h2>
                                <div class="listrippriceinclude">
                                    <span>the price includes:</span>
                                    <div class="benefit-icon-box d-flex">
                                        <div class="benefit-icon">
                                            <div title="Accommodation in hotel &quot;Koukounaria 4 *&quot;"><svg class="" width="18"
                                                                                                                 height="18" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg"
                                                                                                                 style="display: inline-block; vertical-align: middle;">
                                                    <path
                                                        d="M933.647 903.529h-60.235v-542.118c0-102.4-78.306-180.706-180.706-180.706h-361.412c-102.4 0-180.706 78.306-180.706 180.706v542.118h-60.235c-36.141 0-60.235 24.094-60.235 60.235s24.094 60.235 60.235 60.235h843.294c36.141 0 60.235-24.094 60.235-60.235s-24.094-60.235-60.235-60.235zM752.941 903.529h-180.706v-60.235c0-36.141-24.094-60.235-60.235-60.235s-60.235 24.094-60.235 60.235v60.235h-180.706v-542.118c0-36.141 24.094-60.235 60.235-60.235h361.412c36.141 0 60.235 24.094 60.235 60.235v542.118z"
                                                        style="fill: rgb(156, 169, 186);"></path>
                                                    <path
                                                        d="M331.294 120.471h361.412c36.141 0 60.235-24.094 60.235-60.235s-24.094-60.235-60.235-60.235h-361.412c-36.141 0-60.235 24.094-60.235 60.235s24.094 60.235 60.235 60.235z"
                                                        style="fill: rgb(156, 169, 186);"></path>
                                                </svg></div>
                                        </div>

                                        <div class="benefit-icon">
                                            <div title="Small handbag size 1 pc.  luggage, per person (40 x 30 x 20 cm)"><svg class=""
                                                                                                                              width="18" height="18" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg"
                                                                                                                              style="display: inline-block; vertical-align: middle;">
                                                    <path
                                                        d="M905.846 315.077h-118.154v-98.462c0-98.462-70.892-177.231-157.538-177.231h-236.308c-86.646 0-157.538 78.769-157.538 177.231v98.462h-118.154c-66.954 0-118.154 51.2-118.154 118.154v433.231c0 66.954 51.2 118.154 118.154 118.154h787.692c66.954 0 118.154-51.2 118.154-118.154v-433.231c0-66.954-51.2-118.154-118.154-118.154zM393.846 118.154h236.308c43.323 0 78.769 43.323 78.769 98.462v98.462h-393.846v-98.462c0-55.138 35.446-98.462 78.769-98.462zM315.077 393.846h393.846v512h-393.846v-512zM78.769 866.462v-433.231c0-23.631 15.754-39.385 39.385-39.385h118.154v512h-118.154c-23.631 0-39.385-15.754-39.385-39.385zM945.231 866.462c0 23.631-15.754 39.385-39.385 39.385h-118.154v-512h118.154c23.631 0 39.385 15.754 39.385 39.385v433.231z"
                                                        style="fill: rgb(156, 169, 186);"></path>
                                                </svg></div>
                                        </div>
                                        <div class="benefit-icon">
                                            <div title="Document management"><svg class="" width="18" height="18" viewBox="0 0 1024 1024"
                                                                                  xmlns="http://www.w3.org/2000/svg" style="display: inline-block; vertical-align: middle;">
                                                    <path
                                                        d="M810.667 426.667h-170.667c-25.6 0-42.667 17.067-42.667 42.667s17.067 42.667 42.667 42.667h170.667c25.6 0 42.667-17.067 42.667-42.667s-17.067-42.667-42.667-42.667z"
                                                        style="fill: rgb(156, 169, 186);"></path>
                                                    <path
                                                        d="M810.667 597.333h-170.667c-25.6 0-42.667 17.067-42.667 42.667s17.067 42.667 42.667 42.667h170.667c25.6 0 42.667-17.067 42.667-42.667s-17.067-42.667-42.667-42.667z"
                                                        style="fill: rgb(156, 169, 186);"></path>
                                                    <path
                                                        d="M896 85.333h-128v42.667c0 25.6-17.067 42.667-42.667 42.667s-42.667-17.067-42.667-42.667v-42.667h-341.333v42.667c0 25.6-17.067 42.667-42.667 42.667s-42.667-17.067-42.667-42.667v-42.667h-128c-72.533 0-128 55.467-128 128v597.333c0 72.533 55.467 128 128 128h768c72.533 0 128-55.467 128-128v-597.333c0-72.533-55.467-128-128-128zM938.667 810.667c0 25.6-17.067 42.667-42.667 42.667h-768c-25.6 0-42.667-17.067-42.667-42.667v-597.333c0-25.6 17.067-42.667 42.667-42.667h51.2c17.067 51.2 64 85.333 119.467 85.333s102.4-34.133 119.467-85.333h183.467c17.067 51.2 64 85.333 119.467 85.333s102.4-34.133 119.467-85.333h55.467c25.6 0 42.667 17.067 42.667 42.667v597.333z"
                                                        style="fill: rgb(156, 169, 186);"></path>
                                                    <path
                                                        d="M170.667 725.333h341.333v-341.333h-341.333v341.333zM256 469.333h170.667v170.667h-170.667v-170.667z"
                                                        style="fill: rgb(156, 169, 186);"></path>
                                                </svg></div>
                                        </div>
                                        <div class="benefit-icon">
                                            <div title="Meal type: breakfast and dinner"><svg class="" width="18" height="18"
                                                                                              viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg"
                                                                                              style="display: inline-block; vertical-align: middle;">
                                                    <path
                                                        d="M963.765 1024c-36.141 0-60.235-24.094-60.235-60.235v-222.871h-114.447c-54.212 0-102.4-24.094-138.541-66.259s-48.188-96.376-42.165-150.588l18.071-222.871c18.071-174.682 150.588-301.176 313.224-301.176h24.094c36.141 0 60.235 24.094 60.235 60.235v903.529c0 36.141-24.094 60.235-60.235 60.235zM903.529 126.494c-84.329 18.071-150.588 90.353-156.612 186.729l-24.094 216.847c0 24.094 6.024 48.188 18.071 66.259 12.047 12.047 30.118 24.094 48.188 24.094h114.447v-493.929zM240.941 1024c-36.141 0-60.235-24.094-60.235-60.235v-421.647c-102.4-12.047-180.706-96.376-180.706-198.776v-283.106c0-36.141 24.094-60.235 60.235-60.235s60.235 24.094 60.235 60.235v283.106c0 36.141 24.094 66.259 60.235 78.306v-361.412c0-36.141 24.094-60.235 60.235-60.235s60.235 24.094 60.235 60.235v361.412c36.141-6.024 60.235-42.165 60.235-78.306v-283.106c0-36.141 24.094-60.235 60.235-60.235s60.235 24.094 60.235 60.235v283.106c0 102.4-78.306 186.729-180.706 198.776v421.647c0 30.118-24.094 60.235-60.235 60.235z"
                                                        style="fill: rgb(156, 169, 186);"></path>
                                                </svg></div>
                                        </div>
                                        <div class="benefit-icon">
                                            <div title="Transportation: airport - hotel - airport"><svg class="" width="18" height="18"
                                                                                                        viewBox="0 0 1463 1024" xmlns="http://www.w3.org/2000/svg"
                                                                                                        style="display: inline-block; vertical-align: middle;">
                                                    <path
                                                        d="M1280 343.771l-131.657-21.943c-36.571-7.314-43.886-7.314-58.514-43.886-14.629-29.257-36.571-58.514-73.143-102.4l-73.143-73.143c-73.143-65.829-160.914-102.4-263.314-102.4v0h-241.371c-117.029 0-226.743 51.2-292.571 146.286l-102.4 138.971c-29.257 36.571-43.886 80.457-43.886 131.657v387.657c0 124.343 95.086 219.429 219.429 219.429 95.086 0 175.543-58.514 204.8-146.286h394.971c29.257 87.771 109.714 146.286 204.8 146.286s175.543-58.514 204.8-146.286h160.914c43.886 0 73.143-29.257 73.143-73.143v-241.371c0-109.714-80.457-197.486-182.857-219.429zM219.429 877.714c-43.886 0-73.143-29.257-73.143-73.143s29.257-73.143 73.143-73.143 73.143 29.257 73.143 73.143-29.257 73.143-73.143 73.143zM1024 877.714c-43.886 0-73.143-29.257-73.143-73.143s29.257-73.143 73.143-73.143 73.143 29.257 73.143 73.143-29.257 73.143-73.143 73.143zM1316.571 731.429h-87.771c-29.257-87.771-109.714-146.286-204.8-146.286s-175.543 58.514-204.8 146.286h-394.971c-29.257-87.771-109.714-146.286-204.8-146.286-29.257 0-51.2 7.314-73.143 14.629v-182.857c0-14.629 7.314-29.257 14.629-43.886l102.4-138.971c43.886-58.514 109.714-87.771 175.543-87.771h241.371c58.514 0 117.029 21.943 153.6 65.829l73.143 73.143c21.943 21.943 36.571 43.886 51.2 65.829 29.257 51.2 58.514 102.4 160.914 117.029l131.657 21.943c36.571 7.314 58.514 36.571 58.514 73.143v168.229h7.314z"
                                                        style="fill: rgb(156, 169, 186);"></path>
                                                </svg></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="listripbotm" style="position: relative;">
                                    <div class="row">
                                        <div class="col-md-8 col-8">
                                            <span class="sdghhhhh colorli">08 08 08 - 15 08 2021</span>
                                        </div>
                                        <div class="col-md-4 col-4" style="padding: 0px;">
                                            <div class="mavUYJ" style="bottom: unset;">
                                                <small class="price colorli">Price per person from</small>
                                                <div class="pricehp mbgu6">
                                                    <small>$929</small>
                                                    <h4>$451</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="gobtnbyug">
                                    <a href="./tour-detail.html" class="btn_1 btngrad">Watch the trip</a>
                                </div>
                            </div>
                        </div>

                        <div class="listrips">
                            <div class="box_grid">
                                <figure>

                                    <a href="tour-detail.html"><img src="img/tour_1.jpg" class="img-fluid" alt="" width="800"
                                                                    height="533"></a>
                                    <small>You save $ 67</small>
                                </figure>
                            </div>
                            <div class="listguyb4">
                                <small>Zakynthos, Greece</small>
                                <h2>Arc Triomphe</h2>
                                <div class="listrippriceinclude">
                                    <span>the price includes:</span>
                                    <div class="benefit-icon-box d-flex">
                                        <div class="benefit-icon">
                                            <div title="Accommodation in hotel &quot;Koukounaria 4 *&quot;"><svg class="" width="18"
                                                                                                                 height="18" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg"
                                                                                                                 style="display: inline-block; vertical-align: middle;">
                                                    <path
                                                        d="M933.647 903.529h-60.235v-542.118c0-102.4-78.306-180.706-180.706-180.706h-361.412c-102.4 0-180.706 78.306-180.706 180.706v542.118h-60.235c-36.141 0-60.235 24.094-60.235 60.235s24.094 60.235 60.235 60.235h843.294c36.141 0 60.235-24.094 60.235-60.235s-24.094-60.235-60.235-60.235zM752.941 903.529h-180.706v-60.235c0-36.141-24.094-60.235-60.235-60.235s-60.235 24.094-60.235 60.235v60.235h-180.706v-542.118c0-36.141 24.094-60.235 60.235-60.235h361.412c36.141 0 60.235 24.094 60.235 60.235v542.118z"
                                                        style="fill: rgb(156, 169, 186);"></path>
                                                    <path
                                                        d="M331.294 120.471h361.412c36.141 0 60.235-24.094 60.235-60.235s-24.094-60.235-60.235-60.235h-361.412c-36.141 0-60.235 24.094-60.235 60.235s24.094 60.235 60.235 60.235z"
                                                        style="fill: rgb(156, 169, 186);"></path>
                                                </svg></div>
                                        </div>

                                        <div class="benefit-icon">
                                            <div title="Small handbag size 1 pc.  luggage, per person (40 x 30 x 20 cm)"><svg class=""
                                                                                                                              width="18" height="18" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg"
                                                                                                                              style="display: inline-block; vertical-align: middle;">
                                                    <path
                                                        d="M905.846 315.077h-118.154v-98.462c0-98.462-70.892-177.231-157.538-177.231h-236.308c-86.646 0-157.538 78.769-157.538 177.231v98.462h-118.154c-66.954 0-118.154 51.2-118.154 118.154v433.231c0 66.954 51.2 118.154 118.154 118.154h787.692c66.954 0 118.154-51.2 118.154-118.154v-433.231c0-66.954-51.2-118.154-118.154-118.154zM393.846 118.154h236.308c43.323 0 78.769 43.323 78.769 98.462v98.462h-393.846v-98.462c0-55.138 35.446-98.462 78.769-98.462zM315.077 393.846h393.846v512h-393.846v-512zM78.769 866.462v-433.231c0-23.631 15.754-39.385 39.385-39.385h118.154v512h-118.154c-23.631 0-39.385-15.754-39.385-39.385zM945.231 866.462c0 23.631-15.754 39.385-39.385 39.385h-118.154v-512h118.154c23.631 0 39.385 15.754 39.385 39.385v433.231z"
                                                        style="fill: rgb(156, 169, 186);"></path>
                                                </svg></div>
                                        </div>
                                        <div class="benefit-icon">
                                            <div title="Document management"><svg class="" width="18" height="18" viewBox="0 0 1024 1024"
                                                                                  xmlns="http://www.w3.org/2000/svg" style="display: inline-block; vertical-align: middle;">
                                                    <path
                                                        d="M810.667 426.667h-170.667c-25.6 0-42.667 17.067-42.667 42.667s17.067 42.667 42.667 42.667h170.667c25.6 0 42.667-17.067 42.667-42.667s-17.067-42.667-42.667-42.667z"
                                                        style="fill: rgb(156, 169, 186);"></path>
                                                    <path
                                                        d="M810.667 597.333h-170.667c-25.6 0-42.667 17.067-42.667 42.667s17.067 42.667 42.667 42.667h170.667c25.6 0 42.667-17.067 42.667-42.667s-17.067-42.667-42.667-42.667z"
                                                        style="fill: rgb(156, 169, 186);"></path>
                                                    <path
                                                        d="M896 85.333h-128v42.667c0 25.6-17.067 42.667-42.667 42.667s-42.667-17.067-42.667-42.667v-42.667h-341.333v42.667c0 25.6-17.067 42.667-42.667 42.667s-42.667-17.067-42.667-42.667v-42.667h-128c-72.533 0-128 55.467-128 128v597.333c0 72.533 55.467 128 128 128h768c72.533 0 128-55.467 128-128v-597.333c0-72.533-55.467-128-128-128zM938.667 810.667c0 25.6-17.067 42.667-42.667 42.667h-768c-25.6 0-42.667-17.067-42.667-42.667v-597.333c0-25.6 17.067-42.667 42.667-42.667h51.2c17.067 51.2 64 85.333 119.467 85.333s102.4-34.133 119.467-85.333h183.467c17.067 51.2 64 85.333 119.467 85.333s102.4-34.133 119.467-85.333h55.467c25.6 0 42.667 17.067 42.667 42.667v597.333z"
                                                        style="fill: rgb(156, 169, 186);"></path>
                                                    <path
                                                        d="M170.667 725.333h341.333v-341.333h-341.333v341.333zM256 469.333h170.667v170.667h-170.667v-170.667z"
                                                        style="fill: rgb(156, 169, 186);"></path>
                                                </svg></div>
                                        </div>
                                        <div class="benefit-icon">
                                            <div title="Meal type: breakfast and dinner"><svg class="" width="18" height="18"
                                                                                              viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg"
                                                                                              style="display: inline-block; vertical-align: middle;">
                                                    <path
                                                        d="M963.765 1024c-36.141 0-60.235-24.094-60.235-60.235v-222.871h-114.447c-54.212 0-102.4-24.094-138.541-66.259s-48.188-96.376-42.165-150.588l18.071-222.871c18.071-174.682 150.588-301.176 313.224-301.176h24.094c36.141 0 60.235 24.094 60.235 60.235v903.529c0 36.141-24.094 60.235-60.235 60.235zM903.529 126.494c-84.329 18.071-150.588 90.353-156.612 186.729l-24.094 216.847c0 24.094 6.024 48.188 18.071 66.259 12.047 12.047 30.118 24.094 48.188 24.094h114.447v-493.929zM240.941 1024c-36.141 0-60.235-24.094-60.235-60.235v-421.647c-102.4-12.047-180.706-96.376-180.706-198.776v-283.106c0-36.141 24.094-60.235 60.235-60.235s60.235 24.094 60.235 60.235v283.106c0 36.141 24.094 66.259 60.235 78.306v-361.412c0-36.141 24.094-60.235 60.235-60.235s60.235 24.094 60.235 60.235v361.412c36.141-6.024 60.235-42.165 60.235-78.306v-283.106c0-36.141 24.094-60.235 60.235-60.235s60.235 24.094 60.235 60.235v283.106c0 102.4-78.306 186.729-180.706 198.776v421.647c0 30.118-24.094 60.235-60.235 60.235z"
                                                        style="fill: rgb(156, 169, 186);"></path>
                                                </svg></div>
                                        </div>
                                        <div class="benefit-icon">
                                            <div title="Transportation: airport - hotel - airport"><svg class="" width="18" height="18"
                                                                                                        viewBox="0 0 1463 1024" xmlns="http://www.w3.org/2000/svg"
                                                                                                        style="display: inline-block; vertical-align: middle;">
                                                    <path
                                                        d="M1280 343.771l-131.657-21.943c-36.571-7.314-43.886-7.314-58.514-43.886-14.629-29.257-36.571-58.514-73.143-102.4l-73.143-73.143c-73.143-65.829-160.914-102.4-263.314-102.4v0h-241.371c-117.029 0-226.743 51.2-292.571 146.286l-102.4 138.971c-29.257 36.571-43.886 80.457-43.886 131.657v387.657c0 124.343 95.086 219.429 219.429 219.429 95.086 0 175.543-58.514 204.8-146.286h394.971c29.257 87.771 109.714 146.286 204.8 146.286s175.543-58.514 204.8-146.286h160.914c43.886 0 73.143-29.257 73.143-73.143v-241.371c0-109.714-80.457-197.486-182.857-219.429zM219.429 877.714c-43.886 0-73.143-29.257-73.143-73.143s29.257-73.143 73.143-73.143 73.143 29.257 73.143 73.143-29.257 73.143-73.143 73.143zM1024 877.714c-43.886 0-73.143-29.257-73.143-73.143s29.257-73.143 73.143-73.143 73.143 29.257 73.143 73.143-29.257 73.143-73.143 73.143zM1316.571 731.429h-87.771c-29.257-87.771-109.714-146.286-204.8-146.286s-175.543 58.514-204.8 146.286h-394.971c-29.257-87.771-109.714-146.286-204.8-146.286-29.257 0-51.2 7.314-73.143 14.629v-182.857c0-14.629 7.314-29.257 14.629-43.886l102.4-138.971c43.886-58.514 109.714-87.771 175.543-87.771h241.371c58.514 0 117.029 21.943 153.6 65.829l73.143 73.143c21.943 21.943 36.571 43.886 51.2 65.829 29.257 51.2 58.514 102.4 160.914 117.029l131.657 21.943c36.571 7.314 58.514 36.571 58.514 73.143v168.229h7.314z"
                                                        style="fill: rgb(156, 169, 186);"></path>
                                                </svg></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="listripbotm" style="position: relative;">
                                    <div class="row">
                                        <div class="col-md-8 col-8">
                                            <span class="sdghhhhh colorli">08 08 08 - 15 08 2021</span>
                                        </div>
                                        <div class="col-md-4 col-4" style="padding: 0px;">
                                            <div class="mavUYJ" style="bottom: unset;">
                                                <small class="price colorli">Price per person from</small>
                                                <div class="pricehp mbgu6">
                                                    <small>$929</small>
                                                    <h4>$451</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="gobtnbyug">
                                    <a href="./tour-detail.html" class="btn_1 btngrad">Watch the trip</a>
                                </div>
                            </div>
                        </div>
                        --}}
                    </div>

                    <p class="text-center add_top_30"><a href="#0" data-paginate="2" id="load-more" class="btn_1 btngrad">Load more</a></p>
                </div>
                <!-- /col -->
            </div>
            <!-- /row -->
        </div>
    </div>

@endsection
@section('scripts')
    @parent
    <script type="text/javascript">
        var paginate = 1;
        var total=0;
        var sort='{{request()->sort??'id'}}';
        loadMoreData(paginate);

        $('#load-more').click(function() {
            var page = $(this).data('paginate');
            loadMoreData(page);
            $(this).data('paginate', page+1);
        });
        function sort_trips(sorting){
            sort=sorting;
            loadMoreData(paginate);
        }
        // run function when user click load more button
        function loadMoreData(paginate) {
            $.ajax({
                url: '?page=' + paginate+'&sort='+sort,
                type: 'get',
                datatype: 'json',
                beforeSend: function() {
                    $('#load-more').text('Loading...');
                }
            })
                .done(function(data) {
                    if(data.html.length == 0) {
                        $('.invisible').removeClass('invisible');
                        $('#load-more').hide();
                        return;
                    } else {
                        $('#load-more').text('Load more...');
                        $('#trips').append(data.html);
                        if(total<=0){
                            total=data.total;
                            $('#total_events').html(total);
                        }
                    }
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    alert('Something went wrong.');
                });
        }
    </script>
@endsection
