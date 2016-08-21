<nav class="navbar navbar-inverse navbar-fixed-top" style="background-color: #800000">
    <div class="container">
        <div class="row">
            <div class="col-md-1">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/" style="padding-top: 7px;">
                        <img alt="Brand" src="/img/monkeyfist_thumbnail.png" class="img-rounded" height="37" style="margin-top: 1px;">
                    </a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
            </div>
            <div class="col-md-11">
                <div id="internal_navbar" class="collapse navbar-collapse">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group" style="margin-bottom: 0px;">
                                <ui-select ng-model="selectedItem" theme="bootstrap">
                                    <ui-select-match placeholder="Search for persons or feeds...">
                                        <span ng-bind="$select.selected.name"></span>
                                    </ui-select-match>
                                    <ui-select-choices group-by="groupFN" repeat="item in (items | filter: $select.search) track by item.id" refresh="search($select.search)" refresh-delay="0">
                                        <div ng-if="item.type == 'user'">
                                            <div style="display: inline-block;">
                                                <img src="/img/default-profile.png" height="32" />
                                            </div>
                                            <div style="display: inline-block; margin-left: 15px;">
                                                <a style="font-size: large; color: #800000;" href="/profile/{{ item.id }}" ng-bind-html="item.username | highlight: $select.search"></a>
                                            </div>
                                        </div>
                                        <span ng-bind="item.id" ng-if="item.type == 'feed'"></span>
                                    </ui-select-choices>
                                </ui-select>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="navbar_links text-right">
                                <ul class="nav navbar-nav navbar-right">
                                    <li><a href="/profile/{{ user.id }}" title="Profile">{{ user.username }}</a></li>
                                    <li><a href="/dashboard" title="Dashboard">Dashboard</a></li>
                                    <li><a href="/" title="Your Friends"><i class="fa fa-users"></i></a></li>
                                    <!-- <li><a href="#" title="Friend Requests"><i class="fa fa-user-plus"></i></a></li> -->
                                    <li><a href="#" title="Messages"><i class="fa fa-envelope-o"></i></a></li>
                                    <li><a href="/logout" title="Sign Out"><i class="fa fa-sign-out"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>