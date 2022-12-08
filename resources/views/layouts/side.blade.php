        <div id="sidebar" class="sidebar sidebar-grid" style="background: #0e0e66;">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar user -->
				<ul class="nav">
					<li class="nav-profile">
						<a href="javascript:;" data-toggle="nav-profile">
							<div class="cover" style="background:url({{url_plug()}}/img/bg.jpg);background-size: 100%;"></div>
							<div class="image">
								<img src="{{url_plug()}}/img/akun.png" alt="" />
							</div>
							<div class="info">
								<b class="caret pull-right"></b>{{Auth::user()->name}}
								<small>Admnistrator</small>
							</div>
						</a>
					</li>
					<li>
						<ul class="nav nav-profile">
							<li><a href="javascript:;"><i class="fa fa-cog"></i> Settings</a></li>
							<li><a href="javascript:;"><i class="fa fa-pencil-alt"></i> Send Feedback</a></li>
							<li><a href="javascript:;"><i class="fa fa-question-circle"></i> Helps</a></li>
						</ul>
					</li>
				</ul>
				<!-- end sidebar user -->
				<!-- begin sidebar nav -->
				<ul class="nav"><li class="nav-header">Navigation</li>
					<li class=" @if(Request::is('home')==1 || Request::is('/')==1) active @endif">
						<a href="{{url('/')}}">
							<i class="fa fa-home"></i> 
							<span>Home</span>
						</a>
					</li>
					
					<li class="has-sub closed">
						<a href="javascript:;">
							<b class="caret"></b>
							<i class="fa fa-clone"></i>
							<span>Master</span>
						</a>
						<ul class="sub-menu" style="display: none;">
							
							<li><a href="{{url('supplier')}}">Supplier</a></li>
							<li><a href="{{url('barang')}}">Barang</a></li>
							<li><a href="{{url('employe')}}">Pegawai</a></li>
							
						</ul>
					</li>
					<li class="has-sub @if(Request::is('stokorder/*')==1 || Request::is('stokorder')==1 || Request::is('stok')==1 || Request::is('stok/*')==1) active @endif">
						<a href="javascript:;">
							<b class="caret"></b>
							<i class="fa fa-clone"></i>
							<span>Stok</span>
						</a>
						<ul class="sub-menu" @if(Request::is('stokorder/*')==1 || Request::is('stokorder')==1 || Request::is('stok')==1 || Request::is('stok/*')==1) style="display: block;" @endif>
							
							<li><a href="{{url('stokorder')}}">Order Stok</a></li>
							<li><a href="{{url('stok')}}">Stok Tersedia</a></li>
							<li><a href="{{url('stokorder/retur')}}">Retur Barang</a></li>
							<li><a href="{{url('stokorder/tukar')}}">Tukar Satuan</a></li>
						</ul>
					</li>
					<li class=" @if(Request::is('keuangan')==1) active @endif">
						<a href="{{url('/keuangan')}}">
							<i class="fas fa-money-bill-alt"></i> 
							<span>Keuangan</span>
						</a>
					</li>
					<li class=" @if(Request::is('kasir')==1) active @endif">
						<a href="{{url('/kasir')}}">
							<i class="fas fa-calculator"></i> 
							<span>Kasir</span>
						</a>
					</li>
					
					<li>
						<a href="{{url('/setting')}}">
							<i class="fa fa-cog"></i> 
							<span>Setting</span>
						</a>
					</li>
					<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
					
				</ul>
				<!-- end sidebar nav -->
			</div>
			<!-- end sidebar scrollbar -->
		</div>