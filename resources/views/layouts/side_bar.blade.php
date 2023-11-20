<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{route('dashboard')}}" class="app-brand-link">
            <span class="app-brand-logo demo">ABC BANK</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
        </div>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{Route::currentRouteName() == 'dashboard'?'active':''}}">
            <a href="{{route('dashboard')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Home</div>
            </a>
        </li>
        <li class="menu-item {{Route::currentRouteName() == 'deposit'?'active':''}}">
            <a href="{{route('deposit')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-cloud-upload"></i>
            <div data-i18n="Analytics">Deposit</div>
            </a>
        </li>
        <li class="menu-item {{Route::currentRouteName() == 'withdraw'?'active':''}}">
            <a href="{{route('withdraw')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-cloud-download"></i>
            <div data-i18n="Analytics">Withdraw</div>
            </a>
        </li>
        <li class="menu-item {{Route::currentRouteName() == 'transfer'?'active':''}}">
            <a href="{{route('transfer')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-transfer"></i>
            <div data-i18n="Analytics">Transfer</div>
            </a>
        </li>
        <li class="menu-item {{Route::currentRouteName() == 'statement'?'active':''}}">
            <a href="{{route('statement')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-file"></i>
            <div data-i18n="Analytics">Statement</div>
            </a>
        </li>
        <li class="menu-item {{Route::currentRouteName() == 'logout'?'active':''}}">
            <a href="{{route('logout')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-log-out"></i>
            <div data-i18n="Analytics">Logout</div>
            </a>
        </li>

        
    </ul>
</aside>