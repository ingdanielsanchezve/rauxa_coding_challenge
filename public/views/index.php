<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>GitHub Users Search based on Gentallela Alela! | </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="css/custom.css" rel="stylesheet">

    <!-- Angular JS -->
    <script src="bower_components/angular/angular.min.js"></script>
    <script src="bower_components/angular-repeat-n/dist/angular-repeat-n.min.js"></script>    
    <link href="bower_components/utatti-perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <script src="bower_components/utatti-perfect-scrollbar/dist/perfect-scrollbar.js"></script>
    <script src="bower_components/angular-perfect-scrollbar/src/angular-perfect-scrollbar.js"></script>

    <script src="app/app.js"></script>
    <script src="app/searchController.js"></script>
    <script src="app/GitHubService.js"></script>
  </head>

  <body class="nav-md" data-ng-app="gitHubSearchApp" data-ng-controller="searchController">
    <div class="container body" ng-cloak>
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-github"></i> <span>GitHub Users Search</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <img src="images/img.jpeg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <h2>Daniel Sánchez</h2>
                <h2>Computer Engineer</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->        
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">

          <div class="nav_menu">
            <nav class="" role="navigation">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/img.jpeg" alt="">Daniel Sánchez
                  </a>
                </li>

              </ul>
            </nav>
          </div>

        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">

          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>GitHub Users Search</h3>
              </div>

              <div class="title_right">
                <div class="col-md-10 col-sm-10 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for..." ng-model="username" ng-keypress="searchGitHubEnter($event)">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button" ng-click="searchGitHub()">Go! <i ng-if="searching" class="fa fa-spin fa-spinner"></i>  </button>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>User Profile </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="alert alert-success alert-dismissible fade in" role="alert" ng-if="searching">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <strong>Searching!</strong> we are looking for the GitHub user data. <i class="fa fa-rocket"></i>
                    </div>

                    <div class="alert alert-primary alert-dismissible fade in" role="alert" ng-if="err">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <strong>{{err.message}}!</strong> the user you try to find does not exist, please try again.
                    </div>

                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">

                      <div class="profile_img">

                        <!-- end of image cropping -->
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img ng-if="user.avatar_url" class="img-responsive avatar-view" ng-src="{{user.avatar_url}}" alt="Avatar" title="View {{user.login}} on GitHub ">

                        </div>
                        <!-- end of image cropping -->

                      </div>
                      <h3>{{user.name}}</h3>
                      <h4>{{user.login}}</h4>

                      <ul class="list-unstyled user_data">
                        <li ng-if="user.location"><i class="fa fa-map-marker user-profile-icon"></i> {{user.location}} </li>

                        <li ng-if="user.bio"> <i class="fa fa-briefcase user-profile-icon"></i> {{user.bio}} </li>

                        <li class="m-top-xs" ng-if="user.blog">
                          <i class="fa fa-external-link user-profile-icon"></i>
                          <a ng-href="{{user.blog}}" target="_blank">{{user.blog}}</a>
                        </li>
                      </ul>                      

                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <div class="row">

                        <div class="alert alert-success alert-dismissible fade in" role="alert" ng-if="searchingFollowers">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                              </button>
                              <strong>Searching!</strong> we are looking for the user followers data. <i class="fa fa-people"></i>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                          <ul class="pagination pagination-split">

                              <li ng-repeat-n="{{pages}}" ng-if="pages > 0">
                                <a href="#" ng-click="getFollowers($index + 1)">{{$index + 1}}</a>
                              </li>
                              <li ng-if="totPages > maxPages && !searching">
                                <a href="#" ng-click="getMoreFollowersPages(pagesShown)"> More + </a>
                              </li>

                          </ul>
                        </div>

                      <div class="clearfix"></div>

                      <perfect-scrollbar class="scroller" wheel-propagation="true" wheel-speed="10" min-scrollbar-length="20">

                        <div class="col-md-4 col-sm-4 col-xs-12 profile_details" ng-repeat="follower in followers">
                          <div class="well profile_view">
                            <div class="col-sm-12">
                              <div class="left col-xs-7">
                                <h2>{{follower.login}}</h2>                              
                              </div>
                              <div class="right col-xs-5 text-center">
                                <img ng-src="{{follower.avatar_url}}" alt="" class="img-circle img-responsive">
                              </div>
                            </div>
                            <div class="col-xs-12 bottom text-center">
                              <div class="col-xs-12 col-sm-6 emphasis">
                                <a type="button" class="btn btn-success btn-xs" ng-click="searchGitHubSelected(follower.login)">
                                  <i class="fa fa-search"> </i> View Profile
                                </a>
                              </div>
                              <div class="col-xs-12 col-sm-6 emphasis">
                                <a type="button" class="btn btn-primary btn-xs" target="_blank" ng-href="{{follower.html_url}}">
                                  <i class="fa fa-github"> </i> View on GitHub
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>

                      </perfect-scrollbar>
                      
                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        
      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="js/custom.js"></script>
  </body>
</html>