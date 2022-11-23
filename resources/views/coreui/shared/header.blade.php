

    <div class="c-wrapper">
      <header class="c-header c-header-light c-header-fixed c-header-with-subheader">
        <ul class="c-header-nav d-md-down-none">
          <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="/">Dashboard</a></li>
          <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="/users">Users</a></li>
          @if (Auth::check())
            <li class="c-header-nav-item px-3">
                <form action="/logout" method="POST"> @csrf <button type="submit" class="btn btn-ghost-dark btn-block">Logout</button></form></a>
            </li>
          @endif
        </ul>
        <ul class="c-header-nav ml-auto">
          <li class="c-header-nav-item px-3">
            <button class="c-class-toggler c-header-nav-btn" type="button" id="header-tooltip" data-target="body" data-class="c-dark-theme" data-toggle="c-tooltip" data-placement="bottom" title="Toggle Light/Dark Mode">
              <svg class="c-icon c-d-dark-none">
                <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-moon"></use>
              </svg>
              <svg class="c-icon c-d-light-none">
                <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-sun"></use>
              </svg>
            </button>
          </li>
        </ul>
        <div class="c-subheader px-3">
          <!-- Breadcrumb-->
          <ol class="breadcrumb border-0 m-0">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
            <?php $segments = ''; ?>
            @for($i = 1; $i <= count(Request::segments()); $i++)
                <?php $segments .= '/'. Request::segment($i); ?>
                @if($i < count(Request::segments()))
                    <li class="breadcrumb-item">{{ Request::segment($i) }}</li>
                @else
                    <li class="breadcrumb-item active">{{ Request::segment($i) }}</li>
                @endif
            @endfor
            <!-- Breadcrumb Menu-->
          </ol>
      </header>
