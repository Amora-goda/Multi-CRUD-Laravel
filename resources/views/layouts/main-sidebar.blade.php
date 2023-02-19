      <!--start sidebar -->
      <aside class="sidebar-wrapper">
        <div class="iconmenu">
          <div class="nav-toggle-box">
            <div class="nav-toggle-icon"><i class="bi bi-list"></i></div>
          </div>
          <ul class="nav nav-pills flex-column">

            <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="eCommerce">
              <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-ecommerce" type="button"><i class="bi bi-bag-check-fill"></i></button>
            </li>
            <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Components">
              <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-components" type="button"><i class="bi bi-bookmark-star-fill"></i></button>
            </li>
            <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Forms">
              <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-forms" type="button"><i class="bi bi-file-earmark-break-fill"></i></button>
            </li>

          </ul>
        </div>
        <div class="textmenu">
          <div class="brand-logo">
            <img src="{{ asset("assets/images/brand-logo-2.png") }}" width="140" alt=""/>
          </div>
          <div class="tab-content">
            <div class="tab-pane fade" id="pills-dashboards">
              <div class="list-group list-group-flush">
                <div class="list-group-item">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-0">Dashboards</h5>
                  </div>
                  <small class="mb-0">Some placeholder content</small>
                </div>
                <a href="{{ url("index.html") }}" class="list-group-item"><i class="bi bi-cart-plus"></i>e-Commerce</a>
                <a href="{{ url("index2.html") }}" class="list-group-item"><i class="bi bi-wallet"></i>Sales</a>
                <a href="{{ url("index3.html") }}" class="list-group-item"><i class="bi bi-bar-chart-line"></i>Analytics</a>
                <a href="{{ url("index4.html") }}" class="list-group-item"><i class="bi bi-archive"></i>Project Management</a>
                <a href="{{ url("index5.html") }}" class="list-group-item"><i class="bi bi-cast"></i>CMS Dashboard</a>
              </div>
            </div>
            <div class="tab-pane fade" id="pills-application">
              <div class="list-group list-group-flush">
                <div class="list-group-item">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-0">Application</h5>
                  </div>
                  <small class="mb-0">Some placeholder content</small>
                </div>
                <a href="{{ url("app-emailbox.html") }}" class="list-group-item"><i class="bi bi-envelope"></i>Email</a>
                <a href="{{ url("app-chat-box.html") }}" class="list-group-item"><i class="bi bi-chat-left-text"></i>Chat Box</a>
                <a href="{{ url("app-file-manager.html") }}" class="list-group-item"><i class="bi bi-archive"></i>File Manager</a>
                <a href="{{ url("app-to-do.html") }}" class="list-group-item"><i class="bi bi-check2-square"></i>Todo List</a>
                <a href="{{ url("app-invoice.html") }}" class="list-group-item"><i class="bi bi-receipt"></i>Invoice</a>
              </div>
            </div>
            <div class="tab-pane fade" id="pills-widgets">
              <div class="list-group list-group-flush">
                <div class="list-group-item">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-0">Widgets</h5>
                  </div>
                  <small class="mb-0">Some placeholder content</small>
                </div>
                <a href="{{ url("widgets-static-widgets.html") }}" class="list-group-item"><i class="bi bi-box"></i>Static Widgets</a>
                <a href="{{ url("widgets-data-widgets.html") }}" class="list-group-item"><i class="bi bi-bar-chart"></i>Data Widgets</a>
              </div>
            </div>
            <div class="tab-pane fade" id="pills-ecommerce">
              <div class="list-group list-group-flush">
                <div class="list-group-item">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-0">eCommerce</h5>
                  </div>
                  <small class="mb-0">Some placeholder content</small>
                </div>
                {{-- <a href="{{ route('filter_categories') }}" class="list-group-item"><i class="bi bi-card-text"></i>Filter Categories</a> --}}
                @can('show category')
                <a href="{{ route('categories') }}" class="list-group-item"><i class="bi bi-card-text"></i>{{trans('main-trans.categories')}}</a>
                @endcan
                @can('show category')
                <a href="{{ url('sub_categories') }}" class="list-group-item"><i class="bi bi-card-text"></i>{{trans('main-trans.subcategories')}}</a>
                @endcan

                <a href="{{ url('products') }}" class="list-group-item"><i class="bi bi-box-seam"></i>{{trans('main-trans.products')}}</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-gray-200 rounded-lg dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                    href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
                    </form>
              </div>
            </div>

          </div>
        </div>
     </aside>
     <!--start sidebar -->
