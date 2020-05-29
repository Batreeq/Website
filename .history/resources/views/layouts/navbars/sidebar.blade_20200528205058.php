<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-mini">Jara</a>
            <a href="#" class="simple-text logo-normal">أهلا بك في </a>
        </div>
        <ul class="nav">
            <li @if ($pageSlug == 'dashboard') class="active sidebar-contorol-panel" @else class=" sidebar-contorol-panel"   @endif>
                <a href="/dashboard">

                    <p>لوحة التحكم </p>
                </a>
            </li>
            <?php if(strpos($_SERVER['REQUEST_URI'], 'driver') !== false) {?>
                <li class=" {{ $pageSlug == 'statistics' ? 'active statistics' : '' }} ">
                    <a href="{{ url('/driver_home') }}">
                        <p>الصفحة الرئيسية </p>
                    </a>
                </li>
                <li class=" {{ $pageSlug == 'statistics' ? 'active statistics' : '' }} ">
                    <a href="{{ url('/driver_home') }}">
                        <p>طلبات التوظيف </p>
                    </a>
                </li>
                <li class=" {{ $pageSlug == 'statistics' ? 'active statistics' : '' }} ">
                    <a href="{{ url('/driver_home') }}">
                        <p>السائقين </p>
                    </a>
                </li>
                <li class=" {{ $pageSlug == 'statistics' ? 'active statistics' : '' }} ">
                    <a href="{{ url('/driver_home') }}">
                        <p>المراسلة </p>
                    </a>
                </li>
                <li class=" {{ $pageSlug == 'statistics' ? 'active statistics' : '' }} ">
                    <a href="{{ url('/driver_home') }}">
                        <p>الصفحة الرئيسية </p>
                    </a>
                </li>
                <li class=" {{ $pageSlug == 'statistics' ? 'active statistics' : '' }} ">
                    <a href="{{ url('/driver_home') }}">
                        <p>الصفحة الرئيسية </p>
                    </a>
                </li>
            <?php } else { ?>
            <li
                @if ($pageSlug == 'product-category')
                   class="active products"
                @elseif ($pageSlug == 'category')
                    class="active products"
                @elseif ($pageSlug == 'products')
                    class="active products"
                @elseif ($pageSlug == 'product-add')
                     class="active products"
                @else
                    class=""
                @endif>

                <a data-toggle="collapse" href="#laravel-examples" aria-expanded="false" class="collapsed arrow-collapsed">
                  <b class="caret mt-1"></b>

                </a>
                <a href="{{ route('pages.product-category') }}">

                    <p>المنتجات & التصنيفات </p>
                </a>

                 <div class="collapse " id="laravel-examples">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'category') class="active " @endif>
                            <a href="{{ route('pages.category') }}">

                                <p>التصنيفات </p>
                            </a>
                        </li>
                       <li @if ($pageSlug == 'products') class="active " @endif>
                            <a href="{{ route('pages.products') }}">

                                <p>المنتجات</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'product-add') class="active " @endif>
                            <a href="{{ route('pages.product-add') }}">

                                <p>إضافة منتج</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li @if ($pageSlug == 'work-us') class="active work-us" @endif>
                <a href="{{ route('pages.work-us') }}">

                    <p>قسم أعمل معنا </p>
                </a>
            </li>
            <li @if ($pageSlug == 'home-differents-parts') class="active different-parts " @endif>
                <a href="{{ route('pages.home-differents-parts') }}">

                    <p>أجزاء متغيرة </p>
                </a>
            </li>

            <li @if ($pageSlug == 'users') class="active users" @endif>
                <a href="{{ route('pages.users') }}">


                    <p>المستخدمين </p>
                </a>
            </li>
             <li @if ($pageSlug == 'delivery') class="active delivery " @endif>
                <a href="{{ route('pages.delivery') }}">

                    <p>التوصيل </p>
                </a>
            </li>

            <li
                @if ($pageSlug == 'app-pages')
                  class="active app-pages "
                @elseif ($pageSlug == 'terms')
                  class="active app-pages "
                @elseif ($pageSlug == 'question')
                  class="active app-pages "
                @elseif ($pageSlug == 'privacy-policy')
                  class="active app-pages "
                @else class="" @endif>
                <a href="{{ route('pages.app-pages') }}">

                    <p>صفحات التطبيق </p>
                </a>
            </li>
            <li class=" {{ $pageSlug == 'win-with-us' ? 'active win-with-us' : '' }} ">
                <a href="{{ route('pages.win-with-us') }}">

                    <p>نظام اربح معنا </p>
                </a>
            </li>
            <li class=" {{ $pageSlug == 'copons' ? 'active copons' : '' }} ">
                <a href="{{ route('pages.copons') }}">

                    <p>الكوبونات </p>
                </a>
            </li>
            <li class=" {{ $pageSlug == 'statistics' ? 'active statistics' : '' }} ">
                <a href="{{ route('pages.statistics') }}">

                    <p>الإحصائيات </p>
                </a>
            </li>
            <?php } ?>
        </ul>
    </div>
</div>
