		<div id="top-menu" class="top-menu">
			<!-- begin nav -->
			<ul class="nav">
				<li>
					<a href="{{url('/')}}">
						<i class="fa fa-home"></i> 
						<span>Home</span>
					</a>
				</li>
				<li>
					<a href="{{url('/pelayananuser')}}">
						<i class="fa fa-clone"></i> 
						<span>Pelayanan</span>
					</a>
				</li>
				<li>
					<a href="{{url('/pengaduanuser')}}">
						<i class="fa fa-clone"></i> 
						<span>Pengaduan</span>
					</a>
				</li>
				<li>
					<a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
						<i class="fa fa-th-large"></i>
						<span>Logout</span>
					</a>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						@csrf
					</form>
				</li>
				
				
						
			</ul>
			<!-- end nav -->
		</div>