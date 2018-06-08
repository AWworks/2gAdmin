<aside class="main-sidebar">
    <!-- sidebar -->
    <div class="sidebar"  style="margin-left: 10px">

        <ul class="sidebar-menu">
            @role('Admin')
            <li class="active"><a href="{{route('admin.index')}}"><i class="fa fa-home"></i>Dashboard</a></li>
            <li class="treeview"><a href="{{route('merchant.index')}}"><i class="fa fa-list-alt"></i>Merchant List</a>
            </li>
            <li class="treeview"><a href="{{route('cuisine.index')}}"><i class="fa fa-list-alt"></i>Cuisine</a></li>
            <li class="treeview"><a href="{{route('dish.index')}}"><i class="fa fa-list-alt"></i>Dishes</a></li>
            <li class="treeview"><a href="{{route('package.index')}}"><i class="fa fa-list-alt"></i>Packages</a></li>
            <li class="treeview"><a href="{{route('paymentMode.index')}}"><i class="fa fa-list-alt"></i>Payment
                    Modes</a></li>
            <li class="treeview"><a href="{{route('voucher.index')}}"><i class="fa fa-list-alt"></i>Vouchers</a></li>
            <li class="treeview"><a href="{{route('faq.index')}}"><i class="fa fa-list-alt"></i>Faq's</a></li>
            <li class="treeview"><a href="{{route('policy.edit', ['id' => 1])}}"><i
                            class="fa fa-list-alt"></i>Policy</a></li>
            <li class="treeview"><a href="{{route('policy.edit', ['id' => 2])}}"><i
                            class="fa fa-list-alt"></i>Buffer Time</a></li>
            @endrole
            @role('Merchant')
            <li><a href="{{route('admin.index')}}"><i class="fa fa-home"></i>Dashboard</a></li>
            <li><a href="{{route('foodCategory.index')}}"><i class="fa fa-cutlery"></i>Food Category</a></li>
            <li><a href="{{route('foodItem.index')}}"><i class="fa fa-cutlery"></i>Food Item</a></li>
            <li><a href="{{route('size.index')}}"><i class="fa fa-list-alt"></i>Sizes</a></li>
            <li><a href="{{route('addOnCat.index')}}"><i class="fa fa-list-alt"></i>AddOnCategory</a></li>
            <li><a href="{{route('addOnItem.index')}}"><i class="fa fa-list-alt"></i>AddOnItems</a></li>
            <li class="treeview"><a href="{{route('combo.index')}}"><i class="fa fa-list-alt"></i>Combo</a></li>
            <li class="treeview"><a href="{{route('order.index')}}"><i class="fa fa-list-alt"></i>Orders</a></li>
            @endrole
        </ul>
    </div>
</aside>