<footer id="footer" class="footer-wrapper footer-1">
            <!-- Start footer top area -->
            <div class="footer-top-wrap ptb-70 bg-dark">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                            <div class="zm-widget pr-40">
                                <h2 class="h6 zm-widget-title uppercase text-white mb-30">About ABAC</h2>
                                <div class="zm-widget-content">
                                    @foreach($page_content as $index => $info)
                                    @if($info->page_location == 'about_abac_footer')
                                    {!!$info->content!!}
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-2">
                            <div class="zm-widget">
                                <h2 class="h6 zm-widget-title uppercase text-white mb-30">Quick Links</h2>
                                <div class="zm-widget-content">
                                    <div class="zm-social-media zm-social-1 zm-category-widget zm-category-1">
                                        <ul>
                                            <li><a href="{{route('frontend.news.index')}}">NEWS</a></li>
                                            <li><a href="{{route('frontend.gallery.index')}}">GALLERY</a></li>
                                            <li><a href="{{route('frontend.publication')}}">PULBLICATION</a></li>
                                            <li><a href="{{route('frontend.events.index')}}">EVENTS</a></li>
                                            <li><a href="{{route('frontend.contact')}}">CONTACT US</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                            <div class="zm-widget pr-50 pl-20">
                                <h2 class="h6 zm-widget-title uppercase text-white mb-30">&nbsp;</h2>
                                <div class="zm-widget-content">
                                    <div class="zm-category-widget zm-category-1">
                                        <ul>
                                            <li><a href="{{route('frontend.aba')}}">ABA</a></li>
                                            <li><a href="{{route('frontend.abis')}}">ABIS</a></li>
                                            <li><a href="{{route('frontend.asean_bac')}}">ASEAN BAC</a></li>
                                            <li><a href="{{route('frontend.members')}}">MEMBERS</a></li>
                                            {{-- <li><a href="{{route('frontend.partners')}}">PARTNERS</a></li> --}}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                            <div class="zm-widget pr-40">
                                <h2 class="h6 zm-widget-title uppercase text-white mb-30">Contact Information</h2>
                                <div class="zm-widget-content" style="margin-bottom: 2px !important;">
                                    <p>Address: 70 A, Jl. Sisingamangaraja <br>Jakarta 12110, Indonesia</p>
                                    <p>Email: aseanbac@asean.org</p>
                                    <p>Tel No.: + 6221 722 0539</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End footer top area -->
            <div class="footer-buttom bg-black ptb-15">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                            <div class="zm-copyright">
                                <p class="uppercase">&copy; ASEAN Business Advisory Council</p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 text-right hidden-xs">
                            <nav class="footer-menu zm-secondary-menu text-right">
                                <ul>
                                    <li><a href="{{route('frontend.index')}}">Home</a></li>
                                    {{-- <li><a href="#">Privacy Policy</a></li> --}}
                                    <li><a href="{{route('frontend.contact')}}">Contact</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </footer>