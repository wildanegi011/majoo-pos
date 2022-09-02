@if($menu->is_group)
    <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
            <span class="kt-menu__link-text">{{ $menu->name }}</span>
            <i class="kt-menu__hor-arrow la la-angle-right"></i>
        </a>
        <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
            <ul class="kt-menu__subnav">
                @each('templates.metronic-3.partial.header-menu-item', $menu->subMenus, 'menu')
            </ul>
        </div>
    </li>
@else
    @if ($menu->name != 'Muatan Lokal')
        <li class="kt-menu__item " aria-haspopup="true">
            <a href="{{ $menu->base_url }}" class="kt-menu__link">
                @if($menu->icon_2)
                    <i class="kt-menu__link-icon flaticon2-start-up"></i>
                @endif
                <span class="kt-menu__link-text">{{ $menu->name }}</span>
            </a>
        </li>
    @endif
@endif
