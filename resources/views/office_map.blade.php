<x-layout :cssPaths="$cssPaths" :title="$title">
    <script src="https://cdn.jsdelivr.net/npm/image-map-resizer@1.0.0/js/imageMapResizer.min.js"></script>

    <style>
        .circle {

            position: absolute;
            margin-top: 80px;
            margin-left: 10px;




        }
    </style>

    <!-- SIDEBAR -->
    <section id="sidebar" class="hide">
        <span class="brand opacity-0">
            <img src="{{ asset('images/main/logo.png') }}" alt="" style="width:60px">
        </span>
        <ul class="side-menu top">
            <li>

            </li>
            <li>
                <a href="/dashboard">
                    <?php if (auth()->user()->role == 'user'): ?>
                    <i class='bx bxs-home bx-sm'></i>
                    <span class="text">Home</span>
                    <?php else: ?>
                    <i class='bx bxs-dashboard bx-sm'></i>
                    <span class="text">Dashboard</span>
                    <?php endif; ?>
                </a>
            </li>
            @unless (auth()->user()->role == 'user')
                <li>
                    <a href="/bookings">
                        <i class='bx bxs-book-alt bx-sm'></i>
                        <span class="text">Booking</span>
                    </a>
                </li>
            @endunless
            <li class="active">
                <a href="/office_map">
                    <i class='bx bxs-map bx-sm'></i>
                    <span class="text">Office Map</span>
                </a>
            </li>
            @unless (auth()->user()->role == 'user' || auth()->user()->role == 'office_manager')
                <li>
                    <a href="/users">
                        <i class='bx bxs-group bx-sm'></i>
                        <span class="text">Manage Users</span>
                    </a>
                </li>
            @endunless
            <li>
                <a href="/desks/available">
                    @if (auth()->user()->role == 'user')
                        <i class='bx bxs-book bx-sm'></i>
                        <span class="text">Booking</span>
                    @else
                        <i class='bx bx-desktop bx-sm'></i>
                        <span class="text">Manage Desks</span>
                    @endif
                </a>
            </li>
            {{-- <li>
                <a href="/roles">
                    <i class='bx bx-user-pin bx-sm'></i>
                    <span class="text">Manage Roles</span>
                </a>
            </li> --}}
        </ul>
        <ul class="side-menu">
            <li>
                <a href="/faqs">
                    <i class='bx bx-question-mark bx-sm'></i>
                    <span class="text">FAQs</span>
                </a>
            </li>
            <li>
                <a href="/guide">
                    <i class='bx bxs-component bx-sm'></i>
                    <span class="text">User Guide</span>
                </a>
            </li>
            <li>
                <a href="/feedback">
                    <i class='bx bxs-message'></i>
                    <span class="text">Feedback</span>
                </a>
            </li>
            <li>
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="logout">
                        <i class='bx bxs-log-out-circle bx-sm'></i>
                        <span class="text">Logout</span>
                    </button>
                </form>
            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav style="background-color:#dfe1e69c">
            <i class='bx bx-menu bx-sm'></i>
            <h1 class="font-bold text-md text-congressBlue lg:text-xl flex">
                <img class="inline-block h-7 pb-2 lg:h-9 lg:pb-3" src="{{ asset('images/ahs-ape.svg') }}"
                    alt="A">pexHubSpot
            </h1>

            <form action="#">
                <div class="form-input">

                </div>
            </form>

            {{-- <a href="#" class="notification">
                <i class='bx bxs-bell'></i>
                <span class="num">8</span>
            </a> --}}
            @auth
                <a href="/profile" class="profile"
                    style="background-color:black;padding:5px 20px;color:white;border-radius:10px;border:1px solid black;">
                    <div style="display:flex;">
                        @unless (auth()->user()->role == 'user' || auth()->user()->role == 'office_manager' || auth()->user()->role == 'super_admin')
                            <img src="{{ asset('images/admin.jpg') }}" alt=""
                                style="height:30px;border-radius:15px;margin-right:5px">
                        @endunless

                        @unless (auth()->user()->role == 'admin' ||
                                auth()->user()->role == 'office_manager' ||
                                auth()->user()->role == 'super_admin')
                            <img src="{{ asset('images/dummy.png') }}" alt=""
                                style="height:30px;border-radius:15px;margin-right:5px">
                        @endunless

                        @unless (auth()->user()->role == 'admin' || auth()->user()->role == 'user' || auth()->user()->role == 'super_admin')
                            <img src="{{ asset('images/manager.jpg') }}" alt=""
                                style="height:30px;border-radius:15px;margin-right:5px">
                        @endunless
                        @unless (auth()->user()->role == 'admin' || auth()->user()->role == 'user' || auth()->user()->role == 'office_manager')
                            <img src="{{ asset('images/super_admin.png') }}" alt=""
                                style="height:30px;border-radius:15px;margin-right:5px">
                        @endunless
                        {{ auth()->user()->username }}
                    </div>

                </a>
            @else
                <a href="/profile" class="profile font-bold">Profile</a>
            @endauth
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>


        </main>


        <div style="display:flex;margin-left:200px">
            <img src="{{ asset('images/map.png') }}" usemap="#image-map" style="position: relative;bottom:66px">

            <div class="order">


                <h3>
                    <a href="/office_map/availabledesks"
                        style="background-color: rgb(69, 118, 211);color:black;padding:10px;border-radius:10px">Show
                        Available Desks</a>

                </h3>
                <br>
                <p id="desk-title" style="font-size:30px"></p>



            </div>

            <map name="image-map">
                <area target="" alt="DESK1" title="DESK 1" href="" coords="154,141,217,220"
                    shape="rect">
                <area target="" alt="DESK2" title="DESK 2" href="" coords="155,224,218,301"
                    shape="rect">
                <area target="" alt="DESK3" title="DESK 3" href="" coords="154,306,218,384"
                    shape="rect">
                <area target="" alt="DESK4" title="DESK 4" href="" coords="287,84,368,154"
                    shape="rect">
                <area target="" alt="DESK5" title="DESK 5" href="" coords="376,87,530,156"
                    shape="rect">
                <area target="" alt="DESK6" title="DESK 6" href="" coords="536,86,589,133"
                    shape="rect">
                <area target="" alt="DESK7" title="DESK 7" href="" coords="536,136,590,189"
                    shape="rect">
                <area target="" alt="DESK8" title="DESK 8" href="" coords="608,88,660,134"
                    shape="rect">
                <area target="" alt="DESK9" title="DESK 9" href="" coords="610,137,663,190"
                    shape="rect">
                <area target="" alt="DESK10" title="DESK 10" href="" coords="665,89,716,137"
                    shape="rect">
                <area target="" alt="DESK11" title="DESK 11" href="" coords="666,140,718,188"
                    shape="rect">
                <area target="" alt="DESK12" title="DESK 12" href="" coords="737,88,788,137"
                    shape="rect">
                <area target="" alt="DESK13" title="DESK 13" href="" coords="737,140,788,189"
                    shape="rect">
                <area target="" alt="DESK14" title="DESK 14" href="" coords="307,187,357,243"
                    shape="rect">
                <area target="" alt="DESK15" title="DESK 15" href="" coords="361,189,407,240"
                    shape="rect">
                <area target="" alt="DESK16" title="DESK 16" href="" coords="410,186,457,239"
                    shape="rect">
                <area target="" alt="DESK17" title="DESK 17" href="" coords="464,188,512,239"
                    shape="rect">
                <area target="" alt="DESK18" title="DESK 18" href="" coords="308,245,356,295"
                    shape="rect">
                <area target="" alt="DESK19" title="DESK 19" href="" coords="360,242,411,295"
                    shape="rect">
                <area target="" alt="DESK20" title="DESK 20" href="" coords="413,244,459,294"
                    shape="rect">
                <area target="" alt="DESK21" title="DESK 21" href="" coords="462,244,510,297"
                    shape="rect">
                <area target="" alt="DESK22" title="DESK 22" href="" coords="669,231,702,261"
                    shape="rect">
                <area target="" alt="DESK23" title="DESK 23" href="" coords="746,228,780,258"
                    shape="rect">
                <area target="" alt="DESK24" title="DESK 24" href="" coords="670,274,703,305"
                    shape="rect">
                <area target="" alt="DESK25" title="DESK 25" href="" coords="746,275,778,302"
                    shape="rect">
                <area target="" alt="DESK26" title="DESK 26" href="" coords="664,321,715,370"
                    shape="rect">
                <area target="" alt="DESK27" title="DESK 27" href="" coords="662,376,715,422"
                    shape="rect">
                <area target="" alt="DESK28" title="DESK 28" href="" coords="663,428,714,472"
                    shape="rect">
                <area target="" alt="DESK29" title="DESK 29" href="" coords="741,326,791,368"
                    shape="rect">
                <area target="" alt="DESK30" title="DESK 30" href="" coords="741,373,790,412"
                    shape="rect">
                <area target="" alt="DESK31" title="DESK 31" href="" coords="742,418,793,458"
                    shape="rect">
                <area target="" alt="DESK32" title="DESK 32" href="" coords="743,460,793,506"
                    shape="rect">
                <area target="" alt="DESK33" title="DESK 33" href="" coords="299,337,349,381"
                    shape="rect">
                <area target="" alt="DESK34" title="DESK 34" href="" coords="353,337,393,384"
                    shape="rect">
                <area target="" alt="DESK35" title="DESK 35" href="" coords="298,387,348,426"
                    shape="rect">
                <area target="" alt="DESK36" title="DESK 36" href="" coords="353,388,392,427"
                    shape="rect">
                <area target="" alt="DESK37" title="DESK 37" href="" coords="296,430,348,469"
                    shape="rect">
                <area target="" alt="DESK38" title="DESK 38" href="" coords="353,432,393,471"
                    shape="rect">
                <area target="" alt="DESK39" title="DESK 39" href="" coords="298,472,350,515"
                    shape="rect">
                <area target="" alt="DESK40" title="DESK 40" href="" coords="352,477,390,517"
                    shape="rect">
                <area target="" alt="DESK41" title="DESK 41" href="" coords="300,522,348,560"
                    shape="rect">
                <area target="" alt="DESK42" title="DESK 42" href="" coords="351,520,390,565"
                    shape="rect">
                <area target="" alt="DESK43" title="DESK 43" href="" coords="301,565,347,605"
                    shape="rect">
                <area target="" alt="DESK44" title="DESK 44" href="" coords="352,568,389,607"
                    shape="rect">
                <area target="" alt="DESK45" title="DESK 45" href="" coords="479,344,521,387"
                    shape="rect">
                <area target="" alt="DESK46" title="DESK 46" href="" coords="528,343,564,386"
                    shape="rect">
                <area target="" alt="DESK47" title="DESK 47" href="" coords="473,391,522,432"
                    shape="rect">
                <area target="" alt="DESK48" title="DESK 48" href="" coords="528,390,565,431"
                    shape="rect">
                <area target="" alt="DESK49" title="DESK 49" href="" coords="476,436,522,475"
                    shape="rect">
                <area target="" alt="DESK50" title="DESK 50" href="" coords="527,437,571,480"
                    shape="rect">
                <area target="" alt="DESK51" title="DESK 51" href="" coords="476,482,523,522"
                    shape="rect">
                <area target="" alt="DESK52" title="DESK 52" href="" coords="525,483,571,526"
                    shape="rect">
                <area target="" alt="DESK53" title="DESK 53" href="" coords="477,525,523,568"
                    shape="rect">
                <area target="" alt="DESK54" title="DESK 54" href="" coords="527,530,570,566"
                    shape="rect">
                <area target="" alt="DESK55" title="DESK 55" href="" coords="477,572,523,613"
                    shape="rect">
                <area target="" alt="DESK56" title="DESK 56" href="" coords="528,572,572,614"
                    shape="rect">
            </map>


    </section>



    </main>
    </section>
    <!-- CONTENT -->
    <script src="{{ asset('js/booking.js') }}"></script>

    <script>
        const deskTitle = document.getElementById('desk-title');
        const areas = document.querySelectorAll('area');

        const mapContainer = document.querySelector('#content');
        areas.forEach(area => {
            const circle = document.createElement('div');
            circle.className = 'circle';
            circle.style.backgroundColor = 'none';
            circle.style.width = '10px';
            circle.style.height = '10px';
            circle.style.borderRadius = '50%';
            mapContainer.appendChild(circle);

            const coords = area.getAttribute('coords').split(',');
            const x = parseInt(coords[0]);
            const y = parseInt(coords[1]);

            circle.style.left = x + 'px';
            circle.style.top = y + 'px';
            circle.style.position = 'absolute';

            area.addEventListener('click', function(event) {
                event.preventDefault();
                deskTitle.textContent = area.getAttribute('title');
                deskTitle.style.display = 'block';
            });
        });





        ! function() {
            "use strict";

            function r() {
                function e() {
                    var r = {
                            width: u.width / u.naturalWidth,
                            height: u.height / u.naturalHeight
                        },
                        a = {
                            width: parseInt(window.getComputedStyle(u, null).getPropertyValue("padding-left"), 10),
                            height: parseInt(window.getComputedStyle(u, null).getPropertyValue("padding-top"), 10)
                        };
                    i.forEach(function(e, t) {
                        var n = 0;
                        o[t].coords = e.split(",").map(function(e) {
                            var t = 1 == (n = 1 - n) ? "width" : "height";
                            return a[t] + Math.floor(Number(e) * r[t])
                        }).join(",")
                    })
                }

                function t(e) {
                    return e.coords.replace(/ *, */g, ",").replace(/ +/g, ",")
                }

                function n() {
                    clearTimeout(d), d = setTimeout(e, 250)
                }

                function r(e) {
                    return document.querySelector('img[usemap="' + e + '"]')
                }
                var a = this,
                    o = null,
                    i = null,
                    u = null,
                    d = null;
                "function" != typeof a._resize ? (o = a.getElementsByTagName("area"), i = Array.prototype.map.call(o, t),
                    u = r("#" + a.name) || r(a.name), a._resize = e, u.addEventListener("load", e, !1), window
                    .addEventListener("focus", e, !1), window.addEventListener("resize", n, !1), window
                    .addEventListener("readystatechange", e, !1), document.addEventListener("fullscreenchange", e, !1),
                    u.width === u.naturalWidth && u.height === u.naturalHeight || e()) : a._resize()
            }

            function e() {
                function t(e) {
                    e && (! function(e) {
                        if (!e.tagName) throw new TypeError("Object is not a valid DOM element");
                        if ("MAP" !== e.tagName.toUpperCase()) throw new TypeError("Expected <MAP> tag, found <" + e
                            .tagName + ">.")
                    }(e), r.call(e), n.push(e))
                }
                var n;
                return function(e) {
                    switch (n = [], typeof e) {
                        case "undefined":
                        case "string":
                            Array.prototype.forEach.call(document.querySelectorAll(e || "map"), t);
                            break;
                        case "object":
                            t(e);
                            break;
                        default:
                            throw new TypeError("Unexpected data type (" + typeof e + ").")
                    }
                    return n
                }
            }
            "function" == typeof define && define.amd ? define([], e) : "object" == typeof module && "object" ==
                typeof module.exports ? module.exports = e() : window.imageMapResize = e(), "jQuery" in window && (window
                    .jQuery.fn.imageMapResize = function() {
                        return this.filter("map").each(r).end()
                    })
        }();
        imageMapResize();
    </script>


    <div>

    </div>

</x-layout>
