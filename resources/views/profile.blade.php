@extends('layouts.internal')

@section('content')
	
	@if ($self)
		
		<div style="margin: auto; border: 1px solid black; width: 80%;">
			<div class="row" style="height: inherit;">
				<div class="col-md-3 text-center" style="padding-right: 0px;">
					<img src="/img/default-profile.png" class="img-responsive center-block img-circle" width="175" height="175" style="vertical-align: center;" />
				</div>
				<div class="col-md-9" style="padding-left: 0px;">
					<table class="table" style="margin-bottom: 0px;">
						<tr>
							<td colspan="3" class="text-center"><a href="#" style="font-size: x-large; color: #800000;"> {{ $user->username }}</a></td>
						</tr>
						<tr>
							<th>Member since</th>
							<td colspan="2">{{ $user->created_at }}</td>
						</tr>
						<tr>
							<th>Born on</th>
							<td colspan="2">{{ $user->birthday }}</td>
						</tr>
						<tr>
							<td colspan="3" class="text-right">
								<div class="btn-group" style="">
									<button type="button" class="btn btn-default">My Friends&nbsp;<i class="fa fa-users" aria-hidden="true"></i></button>
									<button type="button" class="btn btn-default">Messages&nbsp;<i class="fa fa-envelope" aria-hidden="true"></i></button>
									<button type="button" class="btn btn-default">Settings&nbsp;<i class="fa fa-cog" aria-hidden="true"></i></button>
								</div>
							</td>
						</tr>
					</table>	
				</div>
			</div>
		</div>

	@elseif (!$self and $relation["friends"])

		<div style="margin: auto; border: 1px solid black; width: 80%;">
			<div class="row" style="height: inherit;">
				<div class="col-md-3 text-center" style="padding-right: 0px;">
					<img src="/img/default-profile.png" class="img-responsive center-block img-circle" width="175" height="175" style="vertical-align: center;" />
				</div>
				<div class="col-md-9" style="padding-left: 0px;">
					<table class="table" style="margin-bottom: 0px;">
						<tr>
							<td colspan="3" class="text-center"><a href="#" style="font-size: x-large; color: #800000;"> {{ $user->username }}</a></td>
						</tr>
						<tr>
							<th>Member since</th>
							<td colspan="2">{{ $user->created_at }}</td>
						</tr>
						<tr>
							<th>Born on</th>
							<td colspan="2">{{ $user->birthday }}</td>
						</tr>
						<tr>
							<td colspan="3" class="text-right">
								<div class="btn-group" style="">
									<button type="button" class="btn btn-default">{{ $user->prename }}'s Friends&nbsp;<i class="fa fa-users" aria-hidden="true"></i></button>
									<button type="button" class="btn btn-default">Send Message&nbsp;<i class="fa fa-pencil" aria-hidden="true"></i></button>
									<button type="button" disabled="disabled" class="btn btn-default">Friends&nbsp;<i class="fa fa-check" aria-hidden="true"></i></button>
								</div>
							</td>
						</tr>
					</table>	
				</div>
			</div>
		</div>

	@elseif (!$self and !$relation["friends"] and $relation["status"] == "requested" and $relation["requestedByMe"])

		<div style="margin: auto; border: 1px solid black; width: 80%;">
			<div class="row" style="height: inherit;">
				<div class="col-md-3 text-center" style="padding-right: 0px;">
					<img src="/img/default-profile.png" class="img-responsive center-block img-circle" width="175" height="175" style="vertical-align: center;" />
				</div>
				<div class="col-md-9" style="padding-left: 0px;">
					<table class="table" style="margin-bottom: 0px;">
						<tr>
							<td colspan="3" class="text-center"><a href="#" style="font-size: x-large; color: #800000;"> {{ $user->username }}</a></td>
						</tr>
						<tr>
							<th>Member since</th>
							<td colspan="2">{{ $user->created_at }}</td>
						</tr>
						<tr>
							<th>Born on</th>
							<td colspan="2">{{ $user->birthday }}</td>
						</tr>
						<tr>
							<td colspan="3" class="text-right">
								<div class="btn-group" style="">
									<button type="button" class="btn btn-default">{{ $user->prename }}'s Friends&nbsp;<i class="fa fa-users" aria-hidden="true"></i></button>
									<button type="button" class="btn btn-default">Send Message&nbsp;<i class="fa fa-pencil" aria-hidden="true"></i></button>
									<button type="button" disabled="disabled" class="btn btn-default">Request Sent&nbsp;<i class="fa fa-check" aria-hidden="true"></i></button>
								</div>
							</td>
						</tr>
					</table>	
				</div>
			</div>
		</div>

	@elseif (!$self and !$relation["friends"] and $relation["status"] == "requested" and !$relation["requestedByMe"])

		<div style="margin: auto; border: 1px solid black; width: 80%;">
			<div class="row" style="height: inherit;">
				<div class="col-md-3 text-center" style="padding-right: 0px;">
					<img src="/img/default-profile.png" class="img-responsive center-block img-circle" width="175" height="175" style="vertical-align: center;" />
				</div>
				<div class="col-md-9" style="padding-left: 0px;">
					<table class="table" style="margin-bottom: 0px;">
						<tr>
							<td colspan="3" class="text-center"><a href="#" style="font-size: x-large; color: #800000;"> {{ $user->username }}</a></td>
						</tr>
						<tr>
							<th>Member since</th>
							<td colspan="2">{{ $user->created_at }}</td>
						</tr>
						<tr>
							<th>Born on</th>
							<td colspan="2">{{ $user->birthday }}</td>
						</tr>
						<tr>
							<td colspan="3" class="text-right">
								<div class="btn-group" style="">
									<button type="button" class="btn btn-default">{{ $user->prename }}'s Friends&nbsp;<i class="fa fa-users" aria-hidden="true"></i></button>
									<button type="button" class="btn btn-default">Send Message&nbsp;<i class="fa fa-pencil" aria-hidden="true"></i></button>
									<button type="button" class="btn btn-default">Accept Request&nbsp;<i class="fa fa-thumbs-up" aria-hidden="true"></i></button>
								</div>
							</td>
						</tr>
					</table>	
				</div>
			</div>
		</div>

	@else

		<div style="margin: auto; border: 1px solid black; width: 80%;">
			<div class="row" style="height: inherit;">
				<div class="col-md-3 text-center" style="padding-right: 0px;">
					<img src="/img/default-profile.png" class="img-responsive center-block img-circle" width="175" height="175" style="vertical-align: center;" />
				</div>
				<div class="col-md-9" style="padding-left: 0px;">
					<table class="table" style="margin-bottom: 0px;">
						<tr>
							<td colspan="3" class="text-center"><a href="#" style="font-size: x-large; color: #800000;"> {{ $user->username }}</a></td>
						</tr>
						<tr>
							<th>Member since</th>
							<td colspan="2">{{ $user->created_at }}</td>
						</tr>
						<tr>
							<th>Born on</th>
							<td colspan="2">{{ $user->birthday }}</td>
						</tr>
						<tr>
							<td colspan="3" class="text-right">
								<div class="btn-group" style="">
									<button type="button" class="btn btn-default">{{ $user->prename }}'s Friends&nbsp;<i class="fa fa-users" aria-hidden="true"></i></button>
									<button type="button" class="btn btn-default">Send Message&nbsp;<i class="fa fa-pencil" aria-hidden="true"></i></button>
									<button type="button" class="btn btn-default">Send Friend Request&nbsp;<i class="fa fa-smile-o" aria-hidden="true"></i></button>
								</div>
							</td>
						</tr>
					</table>	
				</div>
			</div>
		</div>

	@endif

@endsection