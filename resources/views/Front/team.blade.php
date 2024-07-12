@extends('Front.layouts.app')

@section('content')
    <section
        class="properties-banner position-relative overflow-hidden deep-blue properties-new-search team-properties-section team-properties-section-new">
        <div class="container">
            <div class="only-title text-center white filter-title">
                <h2>Our Team</h2>
            </div>
            <div class="filter-section d-flex align-items-center">
                {{-- <div class="filter-search">
                    <i class="fas fa-search"></i>
                    <input type="search" name="search" id="search" value="" placeholder="SEARCH BY NAME"
                        onkeyup="fliters()" onsearch="OnSearch (this)">
                </div>
                <div class="filter-search">
                    <select class="form-select form-select-lg mb-3 js-states form-control" name="department" id="department"
                        aria-label="form-select-lg example" onchange="fliters()" onsearch="OnSearch (this)">
                        <option value="ALL" selected>FILTER BY DEPARTMENT</option>
                        @foreach ($employers as $cat => $employee_list)
                            <option value="{{ $cat }}">{{ $cat }}</option>
                        @endforeach
                    </select>
                </div> --}}
                {{-- <div class="filter-search">
                    <select class="form-select form-select-lg mb-3 js-states form-control"
                        aria-label="form-select-lg example">
                        <option selected>FILTER BY COMPANY</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div> --}}
            </div>

            <div class="team-properties-wrap">
                @foreach ($employers as $cat => $employee_list)
                    <div class="team-properties">
                        <div class="properties-title-border">
                            <h2>{{ $cat }}</h2>
                        </div>
                        <div class="leasing-contact">
                            {{-- <div class="contact-box-inner d-flex flex-wrap">
                                @foreach ($employee_list as $employee)
                                    <div class="contact-box ">
                                        <div class="name">
                                            <div class="left">
                                                <div class="team-title">
                                                    <h4>{{ $employee->first_name . ' ' . $employee->last_name }}</h4>
                                                    <span>{{ $employee->position ?? '' }}</span><br />
                                                    <span>{{ $employee->officeType->description ?? '' }}</span>
                                                </div>
                                                <div class="contact-add">
                                                    <ul>
                                                        <li><i class="fas fa-phone-alt"></i><a
                                                                href="tel:{{ $employee->phone }}">{{ $employee->phone }}</a>
                                                        </li>
                                                        <li><i class="fas fa-envelope"></i><a
                                                                href="mailto:{{ $employee->email }}">{{ $employee->email }}</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="right">
                                                <div class="image-wrap">
                                                    <img
                                                        src="{{ !empty($employee->image_relative_url) && File::exists(public_path('employer_image/' . $employee->image_relative_url . '')) ? asset('employer_image/' . $employee->image_relative_url) : asset('app-assets/images/ico/favicon-icon.png') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}

                            {{-- This will force the next line to break --}}
                            {{-- @if ($employee->break_display_after)
                                        <div style="display:block;width: 100%;"></div>
                                    @endif
                                @endforeach
                            </div> --}}
                            <div class="contact-box-inner d-flex flex-wrap">

                                @php
                                    $sectionList = \App\Http\Controllers\Front\OurTeamController::fetchCategory($employee_list, \App\ModelsExtended\OfficeType::New_Jersey_Office);
                                @endphp

                                @if ($sectionList->count() > 0)
                                    @if ( $sectionList->first()->employers_category_id !== \App\ModelsExtended\EmployersCategory::PRINCIPALS &&  $sectionList->first()->employers_category_id !== \App\ModelsExtended\EmployersCategory::LAND_ACQUISITIONS )
                                        <h4>New Jersey Office</h4><br />
                                     @endif
                                    @foreach ($sectionList as $key => $employee)
                                        <div class="contact-box fixed-height-180">
                                            <div class="name">
                                                <div class="left">
                                                    <div class="team-title">
                                                        <h4>{{ $employee->first_name . ' ' . $employee->last_name }}</h4>
                                                        <span>{{ $employee->position ?? '' }}</span>
                                                    </div>
                                                    <div class="contact-add">
                                                        <ul>
                                                            <li><i class="fas fa-phone-alt"></i><a
                                                                    href="tel:{{ $employee->phone }}">{{ \App\Http\Controllers\Controller::formatUSAPhone($employee->phone) }}</a>
                                                            </li>
                                                            <li><i class="fas fa-envelope"></i><a
                                                                    href="mailto:{{ $employee->email }}">{{ $employee->email }}</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="right">
                                                    <div class="image-wrap">
                                                        <img
                                                            src="{{ !empty($employee->image_relative_url) && File::exists(public_path('employer_image/' . $employee->image_relative_url . '')) ? asset('employer_image/' . $employee->image_relative_url) : asset('app-assets/images/ico/favicon-icon.png') }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- This will force the next line to break --}}
                                        @if ($employee->break_display_after)
                                            <div style="display:block;width: 100%;"></div>
                                        @endif
                                    @endforeach
                                @endif

                                @php
                                    $sectionList = \App\Http\Controllers\Front\OurTeamController::fetchCategory($employee_list, \App\ModelsExtended\OfficeType::Pennsylvania_Office);
                                @endphp

                                @if ($sectionList->count() > 0)
                                    @if ( $sectionList->first()->employers_category_id !== \App\ModelsExtended\EmployersCategory::PRINCIPALS &&  $sectionList->first()->employers_category_id !== \App\ModelsExtended\EmployersCategory::LAND_ACQUISITIONS )
                                    <h4>Pennsylvania Office</h4>
                                    @endif
                                    @foreach ($sectionList as $key => $employee)
                                        <div class="contact-box fixed-height-180">
                                            <div class="name">
                                                <div class="left">
                                                    <div class="team-title">
                                                        <h4>{{ $employee->first_name . ' ' . $employee->last_name }}</h4>
                                                        <span>{{ $employee->position ?? '' }}</span>
                                                    </div>
                                                    <div class="contact-add">
                                                        <ul>
                                                            <li><i class="fas fa-phone-alt"></i><a
                                                                    href="tel:{{ $employee->phone }}">{{ \App\Http\Controllers\Controller::formatUSAPhone($employee->phone) }}</a>
                                                            </li>
                                                            <li><i class="fas fa-envelope"></i><a
                                                                    href="mailto:{{ $employee->email }}">{{ $employee->email }}</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="right">
                                                    <div class="image-wrap">
                                                        <img
                                                            src="{{ !empty($employee->image_relative_url) && File::exists(public_path('employer_image/' . $employee->image_relative_url . '')) ? asset('employer_image/' . $employee->image_relative_url) : asset('app-assets/images/ico/favicon-icon.png') }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- This will force the next line to break --}}
                                        @if ($employee->break_display_after)
                                            <div style="display:block;width: 100%;"></div>
                                        @endif
                                    @endforeach
                                @endif

                                
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <style type="text/css">
        .fixed-height-180{ min-height: 180px!important; max-height: 180px!important; }
    </style>
@endsection
@push('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/public-script.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/slick.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript">
        function fliters() {
            var search = $('#search').val();
            var department = $('#department').val();

            $.ajax({
                type: "GET",
                url: "{{ route('team') }}",
                data: {
                    department: department,
                    search: search
                },
                cache: false,
                success: function(response) {
                    if (response.status == 'SUCCESS') {
                        $('.team-properties-wrap').html(response.data);
                    }
                }
            });
        }

        function OnSearch(input) {
            var department = $('#department').val();
            var search = $('#search').val();

            if (search == '' || department == 'ALL') {
                fliters();
            }
        }
    </script>
@endpush
