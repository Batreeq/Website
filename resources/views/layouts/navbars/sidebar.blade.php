<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-mini">Jara</a>
            <a href="#" class="simple-text logo-normal">أهلا بك في </a>
        </div>
        <ul class="nav">
            <li @if ($pageSlug == 'dashboard') class="active sidebar-contorol-panel" @else class=" sidebar-contorol-panel"   @endif>
                <a href="{{ route('dashboard') }}">
                   
                    <p>لوحة التحكم </p>
                </a>
            </li>
           
            <li @if ($pageSlug == 'products') class="active products" @endif>
                <a href="{{ route('pages.products') }}">
                  
                    <p>المنتجات</p>
                </a>
            </li>

             <li @if ($pageSlug == 'categories') class="active categories" @endif>
                <a href="{{ route('pages.category') }}">
                  
                    <p>التصنيقات </p>
                </a>
            </li>
            <li @if ($pageSlug == 'work-us') class="active " @endif>
                <a href="{{ route('pages.work-us') }}">
                   
                    <p>قسم أعمل معنا </p>
                </a>
            </li>
            <li @if ($pageSlug == 'different-parts') class="active different-parts " @endif>
                <a href="{{ route('pages.different-parts') }}">
                  
                    <p>أجزاء متغيرة </p>
                </a>
            </li>
           
            <li @if ($pageSlug == 'users') class="active " @endif>
                <a href="{{ route('pages.users') }}">
                    
                    
                    <p>المستخدمين </p>
                </a>
            </li>
             <li @if ($pageSlug == 'delivery') class="active " @endif>
                <a href="{{ route('pages.delivery') }}">
                   
                    <p>التوصيل </p>
                </a>
            </li>

            <li @if ($pageSlug == 'app-pages') class="active app-pages " @endif>
                <a href="{{ route('pages.app-pages') }}">
                  
                    <p>صفحات التطبيق </p>
                </a>
            </li>
            <li class=" {{ $pageSlug == 'win-with-us' ? 'active' : '' }} ">
                <a href="{{ route('pages.win-with-us') }}">
                  
                    <p>نظام اربح معنا </p>
                </a>
            </li>
            <li class=" {{ $pageSlug == 'copons' ? 'active' : '' }} ">
                <a href="{{ route('pages.copons') }}">
                   
                    <p>الكوبونات </p>
                </a>
            </li>
            <li class=" {{ $pageSlug == 'statistics' ? 'active' : '' }} ">
                <a href="{{ route('pages.statistics') }}">
            
                    <p>الإحصائيات </p>
                </a>
            </li>
        </ul>
    </div>
</div>
