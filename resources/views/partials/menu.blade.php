<aside class="main-sidebar">
    <section class="sidebar" style="height: auto;">
        <ul class="sidebar-menu tree" data-widget="tree">
            <li>
                <a href="{{ route("admin.home") }}">
                    <i class="fas fa-fw fa-tachometer-alt">

                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>
            @can('training_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-chess-board">

                        </i>
                        <span>{{ trans('cruds.training.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('order_access')
                            <li class="{{ request()->is("admin/orders") || request()->is("admin/orders/*") ? "active" : "" }}">
                                <a href="{{ route("admin.orders.index") }}">
                                    <i class="fa-fw fas fa-sort">

                                    </i>
                                    <span>{{ trans('cruds.order.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('specialization_access')
                            <li class="{{ request()->is("admin/specializations") || request()->is("admin/specializations/*") ? "active" : "" }}">
                                <a href="{{ route("admin.specializations.index") }}">
                                    <i class="fa-fw fas fa-suitcase-rolling">

                                    </i>
                                    <span>{{ trans('cruds.specialization.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('course_access')
                            <li class="{{ request()->is("admin/courses") || request()->is("admin/courses/*") ? "active" : "" }}">
                                <a href="{{ route("admin.courses.index") }}">
                                    <i class="fa-fw fas fa-toolbox">

                                    </i>
                                    <span>{{ trans('cruds.course.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('diploma_access')
                            <li class="{{ request()->is("admin/diplomas") || request()->is("admin/diplomas/*") ? "active" : "" }}">
                                <a href="{{ route("admin.diplomas.index") }}">
                                    <i class="fa-fw fas fa-toolbox">

                                    </i>
                                    <span>{{ trans('cruds.diploma.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('lesson_access')
                            <li class="{{ request()->is("admin/lessons") || request()->is("admin/lessons/*") ? "active" : "" }}">
                                <a href="{{ route("admin.lessons.index") }}">
                                    <i class="fa-fw fas fa-check-double">

                                    </i>
                                    <span>{{ trans('cruds.lesson.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('zoom_access')
                            <li class="{{ request()->is("admin/zooms") || request()->is("admin/zooms/*") ? "active" : "" }}">
                                <a href="{{ route("admin.zooms.index") }}">
                                    <i class="fa-fw fas fa-headset">

                                    </i>
                                    <span>{{ trans('cruds.zoom.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('certificate_access')
                            <li class="{{ request()->is("admin/certificates") || request()->is("admin/certificates/*") ? "active" : "" }}">
                                <a href="{{ route("admin.certificates.index") }}">
                                    <i class="fa-fw fas fa-certificate">

                                    </i>
                                    <span>{{ trans('cruds.certificate.title') }}</span>

                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('payment_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-shopping-cart">

                        </i>
                        <span>{{ trans('cruds.payment.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('invoice_access')
                            <li class="{{ request()->is("admin/invoices") || request()->is("admin/invoices/*") ? "active" : "" }}">
                                <a href="{{ route("admin.invoices.index") }}">
                                    <i class="fa-fw fas fa-receipt">

                                    </i>
                                    <span>{{ trans('cruds.invoice.title') }}</span>

                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('blog_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fab fa-blogger">

                        </i>
                        <span>{{ trans('cruds.blog.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('article_access')
                            <li class="{{ request()->is("admin/articles") || request()->is("admin/articles/*") ? "active" : "" }}">
                                <a href="{{ route("admin.articles.index") }}">
                                    <i class="fa-fw fas fa-newspaper">

                                    </i>
                                    <span>{{ trans('cruds.article.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('auther_access')
                            <li class="{{ request()->is("admin/authers") || request()->is("admin/authers/*") ? "active" : "" }}">
                                <a href="{{ route("admin.authers.index") }}">
                                    <i class="fa-fw fas fa-user-graduate">

                                    </i>
                                    <span>{{ trans('cruds.auther.title') }}</span>

                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('forum_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fab fa-forumbee">

                        </i>
                        <span>{{ trans('cruds.forum.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('forum_category_access')
                            <li class="{{ request()->is("admin/forum-categories") || request()->is("admin/forum-categories/*") ? "active" : "" }}">
                                <a href="{{ route("admin.forum-categories.index") }}">
                                    <i class="fa-fw fas fa-cogs">

                                    </i>
                                    <span>{{ trans('cruds.forumCategory.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('thread_access')
                            <li class="{{ request()->is("admin/threads") || request()->is("admin/threads/*") ? "active" : "" }}">
                                <a href="{{ route("admin.threads.index") }}">
                                    <i class="fa-fw fas fa-book-open">

                                    </i>
                                    <span>{{ trans('cruds.thread.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('forum_comment_access')
                            <li class="{{ request()->is("admin/forum-comments") || request()->is("admin/forum-comments/*") ? "active" : "" }}">
                                <a href="{{ route("admin.forum-comments.index") }}">
                                    <i class="fa-fw fas fa-align-left">

                                    </i>
                                    <span>{{ trans('cruds.forumComment.title') }}</span>

                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('user_management_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-users">

                        </i>
                        <span>{{ trans('cruds.userManagement.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('permission_access')
                            <li class="{{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                <a href="{{ route("admin.permissions.index") }}">
                                    <i class="fa-fw fas fa-unlock-alt">

                                    </i>
                                    <span>{{ trans('cruds.permission.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('role_access')
                            <li class="{{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                <a href="{{ route("admin.roles.index") }}">
                                    <i class="fa-fw fas fa-briefcase">

                                    </i>
                                    <span>{{ trans('cruds.role.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('user_access')
                            <li class="{{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                <a href="{{ route("admin.users.index") }}">
                                    <i class="fa-fw fas fa-user">

                                    </i>
                                    <span>{{ trans('cruds.user.title') }}</span>

                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('setting_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-cogs">

                        </i>
                        <span>{{ trans('cruds.setting.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('country_access')
                            <li class="{{ request()->is("admin/countries") || request()->is("admin/countries/*") ? "active" : "" }}">
                                <a href="{{ route("admin.countries.index") }}">
                                    <i class="fa-fw fas fa-flag">

                                    </i>
                                    <span>{{ trans('cruds.country.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('city_access')
                            <li class="{{ request()->is("admin/cities") || request()->is("admin/cities/*") ? "active" : "" }}">
                                <a href="{{ route("admin.cities.index") }}">
                                    <i class="fa-fw fas fa-location-arrow">

                                    </i>
                                    <span>{{ trans('cruds.city.title') }}</span>

                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                @can('profile_password_edit')
                    <li class="{{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}">
                        <a href="{{ route('profile.password.edit') }}">
                            <i class="fa-fw fas fa-key">
                            </i>
                            {{ trans('global.change_password') }}
                        </a>
                    </li>
                @endcan
            @endif
            <li>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul>
    </section>
</aside>