<div class="container-fluid">

	<div ng-include="'/app/templates/includes/navbar.php'" ng-controller="NavbarController"></div>

</div>

<div id="messenger">

	<!-- Sidebar -->
	<div id="messenger_sidebar">
		<ul class="sidebar-nav">
			<!-- <li class="sidebar-brand">
				<button class="btn btn-default"><i class="fa fa-plus"></i> New Message</button>
			</li> -->
			<li class="sidebar-brand">
				<a href="#">
					<div>
						<div style="display: inline-block;">
                            <img src="/img/default-profile.png" height="32" />
                        </div>
                        <div style="display: inline-block;>
                            <span style="font-size: large">Axel Virnich</span>
                        </div>
					</div>
				</a>
			</li>
			<li class="sidebar-brand">
				<a href="#">
					<div>
						<div style="display: inline-block;">
                            <img src="/img/default-profile.png" height="32" />
                        </div>
                        <div style="display: inline-block;>
                            <span style="font-size: large">Michael Ostwald</span>
                        </div>
					</div>
				</a>
			</li>
			<li class="sidebar-brand">
				<a href="#">
					<div>
						<div style="display: inline-block;">
                            <img src="/img/default-profile.png" height="32" />
                        </div>
                        <div style="display: inline-block;>
                            <span style="font-size: large">Michael Henschel</span>
                        </div>
					</div>
				</a>
			</li>
		</ul>
	</div>

	<!-- Main -->
	<div id="messenger_content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<p>This is where the messages will be displayed!</p>
				</div>
			</div>
		</div>
	</div>

</div>