


<!DOCTYPE html>
<html lang="en" class="">
  <head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# object: http://ogp.me/ns/object# article: http://ogp.me/ns/article# profile: http://ogp.me/ns/profile#">
    <meta charset='utf-8'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    
    
    <title>php-calendar/authorize.php at master · jasonjoh/php-calendar</title>
    <link rel="search" type="application/opensearchdescription+xml" href="/opensearch.xml" title="GitHub">
    <link rel="fluid-icon" href="https://github.com/fluidicon.png" title="GitHub">
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-114.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-144.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144.png">
    <meta property="fb:app_id" content="1401488693436528">

      <meta content="@github" name="twitter:site" /><meta content="summary" name="twitter:card" /><meta content="jasonjoh/php-calendar" name="twitter:title" /><meta content="php-calendar - A PHP sample using the Calendar API for Office 365." name="twitter:description" /><meta content="https://avatars3.githubusercontent.com/u/8966342?v=3&amp;s=400" name="twitter:image:src" />
      <meta content="GitHub" property="og:site_name" /><meta content="object" property="og:type" /><meta content="https://avatars3.githubusercontent.com/u/8966342?v=3&amp;s=400" property="og:image" /><meta content="jasonjoh/php-calendar" property="og:title" /><meta content="https://github.com/jasonjoh/php-calendar" property="og:url" /><meta content="php-calendar - A PHP sample using the Calendar API for Office 365." property="og:description" />
      <meta name="browser-stats-url" content="/_stats">
    <link rel="assets" href="https://assets-cdn.github.com/">
    <link rel="conduit-xhr" href="https://ghconduit.com:25035">
    <link rel="xhr-socket" href="/_sockets">
    <meta name="pjax-timeout" content="1000">
    <link rel="sudo-modal" href="/sessions/sudo_modal">

    <meta name="msapplication-TileImage" content="/windows-tile.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="selected-link" value="repo_source" data-pjax-transient>
      <meta name="google-analytics" content="UA-3769691-2">

    <meta content="collector.githubapp.com" name="octolytics-host" /><meta content="collector-cdn.github.com" name="octolytics-script-host" /><meta content="github" name="octolytics-app-id" /><meta content="4182EAE1:41F8:54CE3B6:54F55F04" name="octolytics-dimension-request_id" /><meta content="9954232" name="octolytics-actor-id" /><meta content="slloyd88" name="octolytics-actor-login" /><meta content="5a7253a1615c1d415b87df996fb65ce8ac6b08b26fc770900c5ed75c0eeade67" name="octolytics-actor-hash" />
    
    <meta content="Rails, view, blob#show" name="analytics-event" />

    
    <link rel="icon" type="image/x-icon" href="https://assets-cdn.github.com/favicon.ico">


    <meta content="authenticity_token" name="csrf-param" />
<meta content="+ZeTsF+/8CI0whqi7wihNOyWQmv9JP0KBGJAdNS6lcp+FxynMZnzUFLE7ar7OCOXNWrF4/qG3av+HQAWZtsnmg==" name="csrf-token" />

    <link href="https://assets-cdn.github.com/assets/github-1b7a0fc5ad338a0e75ff6190dd28e8716a22b8155b28f6cdd2e57a545c3daf52.css" media="all" rel="stylesheet" />
    <link href="https://assets-cdn.github.com/assets/github2-3ae58c8acc0b34029297abb04804564d52c2701428e581a26da9d6f15c1f0c54.css" media="all" rel="stylesheet" />
    
    


    <meta http-equiv="x-pjax-version" content="f2b02908531e6d2e960dd84107f159ea">

      
  <meta name="description" content="php-calendar - A PHP sample using the Calendar API for Office 365.">
  <meta name="go-import" content="github.com/jasonjoh/php-calendar git https://github.com/jasonjoh/php-calendar.git">

  <meta content="8966342" name="octolytics-dimension-user_id" /><meta content="jasonjoh" name="octolytics-dimension-user_login" /><meta content="31376491" name="octolytics-dimension-repository_id" /><meta content="jasonjoh/php-calendar" name="octolytics-dimension-repository_nwo" /><meta content="true" name="octolytics-dimension-repository_public" /><meta content="false" name="octolytics-dimension-repository_is_fork" /><meta content="31376491" name="octolytics-dimension-repository_network_root_id" /><meta content="jasonjoh/php-calendar" name="octolytics-dimension-repository_network_root_nwo" />
  <link href="https://github.com/jasonjoh/php-calendar/commits/master.atom" rel="alternate" title="Recent Commits to php-calendar:master" type="application/atom+xml">

  </head>


  <body class="logged_in  env-production windows vis-public page-blob">
    <a href="#start-of-content" tabindex="1" class="accessibility-aid js-skip-to-content">Skip to content</a>
    <div class="wrapper">
      
      
      
      


        <div class="header header-logged-in true" role="banner">
  <div class="container clearfix">

    <a class="header-logo-invertocat" href="https://github.com/" data-hotkey="g d" aria-label="Homepage" data-ga-click="Header, go to dashboard, icon:logo">
  <span class="mega-octicon octicon-mark-github"></span>
</a>


      <div class="site-search repo-scope js-site-search" role="search">
          <form accept-charset="UTF-8" action="/jasonjoh/php-calendar/search" class="js-site-search-form" data-global-search-url="/search" data-repo-search-url="/jasonjoh/php-calendar/search" method="get"><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="&#x2713;" /></div>
  <input type="text"
    class="js-site-search-field is-clearable"
    data-hotkey="s"
    name="q"
    placeholder="Search"
    data-global-scope-placeholder="Search GitHub"
    data-repo-scope-placeholder="Search"
    tabindex="1"
    autocapitalize="off">
  <div class="scope-badge">This repository</div>
</form>
      </div>
      <ul class="header-nav left" role="navigation">
        <li class="header-nav-item explore">
          <a class="header-nav-link" href="/explore" data-ga-click="Header, go to explore, text:explore">Explore</a>
        </li>
          <li class="header-nav-item">
            <a class="header-nav-link" href="https://gist.github.com" data-ga-click="Header, go to gist, text:gist">Gist</a>
          </li>
          <li class="header-nav-item">
            <a class="header-nav-link" href="/blog" data-ga-click="Header, go to blog, text:blog">Blog</a>
          </li>
        <li class="header-nav-item">
          <a class="header-nav-link" href="https://help.github.com" data-ga-click="Header, go to help, text:help">Help</a>
        </li>
      </ul>

    
<ul class="header-nav user-nav right" id="user-links">
  <li class="header-nav-item dropdown js-menu-container">
    <a class="header-nav-link name" href="/slloyd88" data-ga-click="Header, go to profile, text:username">
      <img alt="Steven Lloyd" class="avatar" data-user="9954232" height="20" src="https://avatars2.githubusercontent.com/u/9954232?v=3&amp;s=40" width="20" />
      <span class="css-truncate">
        <span class="css-truncate-target">slloyd88</span>
      </span>
    </a>
  </li>

  <li class="header-nav-item dropdown js-menu-container">
    <a class="header-nav-link js-menu-target tooltipped tooltipped-s" href="#" aria-label="Create new..." data-ga-click="Header, create new, icon:add">
      <span class="octicon octicon-plus"></span>
      <span class="dropdown-caret"></span>
    </a>

    <div class="dropdown-menu-content js-menu-content">
      
<ul class="dropdown-menu">
  <li>
    <a href="/new" data-ga-click="Header, create new repository, icon:repo"><span class="octicon octicon-repo"></span> New repository</a>
  </li>
  <li>
    <a href="/organizations/new" data-ga-click="Header, create new organization, icon:organization"><span class="octicon octicon-organization"></span> New organization</a>
  </li>


    <li class="dropdown-divider"></li>
    <li class="dropdown-header">
      <span title="jasonjoh/php-calendar">This repository</span>
    </li>
      <li>
        <a href="/jasonjoh/php-calendar/issues/new" data-ga-click="Header, create new issue, icon:issue"><span class="octicon octicon-issue-opened"></span> New issue</a>
      </li>
</ul>

    </div>
  </li>

  <li class="header-nav-item">
        <a href="/notifications" aria-label="You have no unread notifications" class="header-nav-link notification-indicator tooltipped tooltipped-s" data-ga-click="Header, go to notifications, icon:read" data-hotkey="g n">
        <span class="mail-status all-read"></span>
        <span class="octicon octicon-inbox"></span>
</a>
  </li>

  <li class="header-nav-item">
    <a class="header-nav-link tooltipped tooltipped-s" href="/settings/profile" id="account_settings" aria-label="Settings" data-ga-click="Header, go to settings, icon:settings">
      <span class="octicon octicon-gear"></span>
    </a>
  </li>

  <li class="header-nav-item">
    <form accept-charset="UTF-8" action="/logout" class="logout-form" method="post"><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="&#x2713;" /><input name="authenticity_token" type="hidden" value="xEdLZ751Ke+XbxiqVg4T9/3Hcl501C3o4DnM7ETjY9qSvaAWOmyFR4zSJV48vy9bTr9gA5qAUE/2taecXcHceA==" /></div>
      <button class="header-nav-link sign-out-button tooltipped tooltipped-s" aria-label="Sign out" data-ga-click="Header, sign out, icon:logout">
        <span class="octicon octicon-sign-out"></span>
      </button>
</form>  </li>

</ul>


    
  </div>
</div>

        

        


      <div id="start-of-content" class="accessibility-aid"></div>
          <div class="site" itemscope itemtype="http://schema.org/WebPage">
    <div id="js-flash-container">
      
    </div>
    <div class="pagehead repohead instapaper_ignore readability-menu">
      <div class="container">
        
<ul class="pagehead-actions">

  <li>
      <form accept-charset="UTF-8" action="/notifications/subscribe" class="js-social-container" data-autosubmit="true" data-remote="true" method="post"><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="&#x2713;" /><input name="authenticity_token" type="hidden" value="35FwiBRJLIY+Wttg3UERSi7qHzj/oeSYy9W8NZ+91qBduCK3X1/yew27Prlbh/HePk5lLqj5tuSI6RDHQhKjDw==" /></div>    <input id="repository_id" name="repository_id" type="hidden" value="31376491" />

      <div class="select-menu js-menu-container js-select-menu">
        <a class="social-count js-social-count" href="/jasonjoh/php-calendar/watchers">
          3
        </a>
        <a href="/jasonjoh/php-calendar/subscription"
          class="minibutton select-menu-button with-count js-menu-target" role="button" tabindex="0" aria-haspopup="true">
          <span class="js-select-button">
            <span class="octicon octicon-eye"></span>
            Watch
          </span>
        </a>

        <div class="select-menu-modal-holder">
          <div class="select-menu-modal subscription-menu-modal js-menu-content" aria-hidden="true">
            <div class="select-menu-header">
              <span class="select-menu-title">Notifications</span>
              <span class="octicon octicon-x js-menu-close" role="button" aria-label="Close"></span>
            </div>

            <div class="select-menu-list js-navigation-container" role="menu">

              <div class="select-menu-item js-navigation-item selected" role="menuitem" tabindex="0">
                <span class="select-menu-item-icon octicon octicon-check"></span>
                <div class="select-menu-item-text">
                  <input checked="checked" id="do_included" name="do" type="radio" value="included" />
                  <span class="select-menu-item-heading">Not watching</span>
                  <span class="description">Be notified when participating or @mentioned.</span>
                  <span class="js-select-button-text hidden-select-button-text">
                    <span class="octicon octicon-eye"></span>
                    Watch
                  </span>
                </div>
              </div>

              <div class="select-menu-item js-navigation-item " role="menuitem" tabindex="0">
                <span class="select-menu-item-icon octicon octicon octicon-check"></span>
                <div class="select-menu-item-text">
                  <input id="do_subscribed" name="do" type="radio" value="subscribed" />
                  <span class="select-menu-item-heading">Watching</span>
                  <span class="description">Be notified of all conversations.</span>
                  <span class="js-select-button-text hidden-select-button-text">
                    <span class="octicon octicon-eye"></span>
                    Unwatch
                  </span>
                </div>
              </div>

              <div class="select-menu-item js-navigation-item " role="menuitem" tabindex="0">
                <span class="select-menu-item-icon octicon octicon-check"></span>
                <div class="select-menu-item-text">
                  <input id="do_ignore" name="do" type="radio" value="ignore" />
                  <span class="select-menu-item-heading">Ignoring</span>
                  <span class="description">Never be notified.</span>
                  <span class="js-select-button-text hidden-select-button-text">
                    <span class="octicon octicon-mute"></span>
                    Stop ignoring
                  </span>
                </div>
              </div>

            </div>

          </div>
        </div>
      </div>
</form>

  </li>

  <li>
    
  <div class="js-toggler-container js-social-container starring-container ">

    <form accept-charset="UTF-8" action="/jasonjoh/php-calendar/unstar" class="js-toggler-form starred js-unstar-button" data-remote="true" method="post"><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="&#x2713;" /><input name="authenticity_token" type="hidden" value="zZHlRHVgLDSGaR9Q0tS7bECshaFwmEGQ0/cfVDXtYPGLDem9Xqy3cL94zX18bsAMgkgtT8It3jK/6oFKMtr/iw==" /></div>
      <button
        class="minibutton with-count js-toggler-target"
        aria-label="Unstar this repository" title="Unstar jasonjoh/php-calendar">
        <span class="octicon octicon-star"></span>
        Unstar
      </button>
        <a class="social-count js-social-count" href="/jasonjoh/php-calendar/stargazers">
          2
        </a>
</form>
    <form accept-charset="UTF-8" action="/jasonjoh/php-calendar/star" class="js-toggler-form unstarred js-star-button" data-remote="true" method="post"><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="&#x2713;" /><input name="authenticity_token" type="hidden" value="n1nDvNuF7f5SeApFWlCE2vWiV7xeauaSQ0as207l7vzMIB/JcXm9FUt5F6RJFR1fXgXjTVpqTklKK/tIesj1VA==" /></div>
      <button
        class="minibutton with-count js-toggler-target"
        aria-label="Star this repository" title="Star jasonjoh/php-calendar">
        <span class="octicon octicon-star"></span>
        Star
      </button>
        <a class="social-count js-social-count" href="/jasonjoh/php-calendar/stargazers">
          2
        </a>
</form>  </div>

  </li>

        <li>
          <a href="/jasonjoh/php-calendar/fork" class="minibutton with-count js-toggler-target tooltipped-n" title="Fork your own copy of jasonjoh/php-calendar to your account" aria-label="Fork your own copy of jasonjoh/php-calendar to your account" rel="facebox nofollow">
            <span class="octicon octicon-repo-forked"></span>
            Fork
          </a>
          <a href="/jasonjoh/php-calendar/network" class="social-count">1</a>
        </li>

</ul>

        <h1 itemscope itemtype="http://data-vocabulary.org/Breadcrumb" class="entry-title public">
          <span class="mega-octicon octicon-repo"></span>
          <span class="author"><a href="/jasonjoh" class="url fn" itemprop="url" rel="author"><span itemprop="title">jasonjoh</span></a></span><!--
       --><span class="path-divider">/</span><!--
       --><strong><a href="/jasonjoh/php-calendar" class="js-current-repository" data-pjax="#js-repo-pjax-container">php-calendar</a></strong>

          <span class="page-context-loader">
            <img alt="" height="16" src="https://assets-cdn.github.com/assets/spinners/octocat-spinner-32-e513294efa576953719e4e2de888dd9cf929b7d62ed8d05f25e731d02452ab6c.gif" width="16" />
          </span>

        </h1>
      </div><!-- /.container -->
    </div><!-- /.repohead -->

    <div class="container">
      <div class="repository-with-sidebar repo-container new-discussion-timeline  ">
        <div class="repository-sidebar clearfix">
            
<nav class="sunken-menu repo-nav js-repo-nav js-sidenav-container-pjax js-octicon-loaders"
     role="navigation"
     data-pjax="#js-repo-pjax-container"
     data-issue-count-url="/jasonjoh/php-calendar/issues/counts">
  <ul class="sunken-menu-group">
    <li class="tooltipped tooltipped-w" aria-label="Code">
      <a href="/jasonjoh/php-calendar" aria-label="Code" class="selected js-selected-navigation-item sunken-menu-item" data-hotkey="g c" data-selected-links="repo_source repo_downloads repo_commits repo_releases repo_tags repo_branches /jasonjoh/php-calendar">
        <span class="octicon octicon-code"></span> <span class="full-word">Code</span>
        <img alt="" class="mini-loader" height="16" src="https://assets-cdn.github.com/assets/spinners/octocat-spinner-32-e513294efa576953719e4e2de888dd9cf929b7d62ed8d05f25e731d02452ab6c.gif" width="16" />
</a>    </li>

      <li class="tooltipped tooltipped-w" aria-label="Issues">
        <a href="/jasonjoh/php-calendar/issues" aria-label="Issues" class="js-selected-navigation-item sunken-menu-item" data-hotkey="g i" data-selected-links="repo_issues repo_labels repo_milestones /jasonjoh/php-calendar/issues">
          <span class="octicon octicon-issue-opened"></span> <span class="full-word">Issues</span>
          <span class="js-issue-replace-counter"></span>
          <img alt="" class="mini-loader" height="16" src="https://assets-cdn.github.com/assets/spinners/octocat-spinner-32-e513294efa576953719e4e2de888dd9cf929b7d62ed8d05f25e731d02452ab6c.gif" width="16" />
</a>      </li>

    <li class="tooltipped tooltipped-w" aria-label="Pull Requests">
      <a href="/jasonjoh/php-calendar/pulls" aria-label="Pull Requests" class="js-selected-navigation-item sunken-menu-item" data-hotkey="g p" data-selected-links="repo_pulls /jasonjoh/php-calendar/pulls">
          <span class="octicon octicon-git-pull-request"></span> <span class="full-word">Pull Requests</span>
          <span class="js-pull-replace-counter"></span>
          <img alt="" class="mini-loader" height="16" src="https://assets-cdn.github.com/assets/spinners/octocat-spinner-32-e513294efa576953719e4e2de888dd9cf929b7d62ed8d05f25e731d02452ab6c.gif" width="16" />
</a>    </li>


      <li class="tooltipped tooltipped-w" aria-label="Wiki">
        <a href="/jasonjoh/php-calendar/wiki" aria-label="Wiki" class="js-selected-navigation-item sunken-menu-item" data-hotkey="g w" data-selected-links="repo_wiki /jasonjoh/php-calendar/wiki">
          <span class="octicon octicon-book"></span> <span class="full-word">Wiki</span>
          <img alt="" class="mini-loader" height="16" src="https://assets-cdn.github.com/assets/spinners/octocat-spinner-32-e513294efa576953719e4e2de888dd9cf929b7d62ed8d05f25e731d02452ab6c.gif" width="16" />
</a>      </li>
  </ul>
  <div class="sunken-menu-separator"></div>
  <ul class="sunken-menu-group">

    <li class="tooltipped tooltipped-w" aria-label="Pulse">
      <a href="/jasonjoh/php-calendar/pulse" aria-label="Pulse" class="js-selected-navigation-item sunken-menu-item" data-selected-links="pulse /jasonjoh/php-calendar/pulse">
        <span class="octicon octicon-pulse"></span> <span class="full-word">Pulse</span>
        <img alt="" class="mini-loader" height="16" src="https://assets-cdn.github.com/assets/spinners/octocat-spinner-32-e513294efa576953719e4e2de888dd9cf929b7d62ed8d05f25e731d02452ab6c.gif" width="16" />
</a>    </li>

    <li class="tooltipped tooltipped-w" aria-label="Graphs">
      <a href="/jasonjoh/php-calendar/graphs" aria-label="Graphs" class="js-selected-navigation-item sunken-menu-item" data-selected-links="repo_graphs repo_contributors /jasonjoh/php-calendar/graphs">
        <span class="octicon octicon-graph"></span> <span class="full-word">Graphs</span>
        <img alt="" class="mini-loader" height="16" src="https://assets-cdn.github.com/assets/spinners/octocat-spinner-32-e513294efa576953719e4e2de888dd9cf929b7d62ed8d05f25e731d02452ab6c.gif" width="16" />
</a>    </li>
  </ul>


</nav>

              <div class="only-with-full-nav">
                  
<div class="clone-url open"
  data-protocol-type="http"
  data-url="/users/set_protocol?protocol_selector=http&amp;protocol_type=clone">
  <h3><span class="text-emphasized">HTTPS</span> clone URL</h3>
  <div class="input-group js-zeroclipboard-container">
    <input type="text" class="input-mini input-monospace js-url-field js-zeroclipboard-target"
           value="https://github.com/jasonjoh/php-calendar.git" readonly="readonly">
    <span class="input-group-button">
      <button aria-label="Copy to clipboard" class="js-zeroclipboard minibutton zeroclipboard-button" data-copied-hint="Copied!" type="button"><span class="octicon octicon-clippy"></span></button>
    </span>
  </div>
</div>

  
<div class="clone-url "
  data-protocol-type="ssh"
  data-url="/users/set_protocol?protocol_selector=ssh&amp;protocol_type=clone">
  <h3><span class="text-emphasized">SSH</span> clone URL</h3>
  <div class="input-group js-zeroclipboard-container">
    <input type="text" class="input-mini input-monospace js-url-field js-zeroclipboard-target"
           value="git@github.com:jasonjoh/php-calendar.git" readonly="readonly">
    <span class="input-group-button">
      <button aria-label="Copy to clipboard" class="js-zeroclipboard minibutton zeroclipboard-button" data-copied-hint="Copied!" type="button"><span class="octicon octicon-clippy"></span></button>
    </span>
  </div>
</div>

  
<div class="clone-url "
  data-protocol-type="subversion"
  data-url="/users/set_protocol?protocol_selector=subversion&amp;protocol_type=clone">
  <h3><span class="text-emphasized">Subversion</span> checkout URL</h3>
  <div class="input-group js-zeroclipboard-container">
    <input type="text" class="input-mini input-monospace js-url-field js-zeroclipboard-target"
           value="https://github.com/jasonjoh/php-calendar" readonly="readonly">
    <span class="input-group-button">
      <button aria-label="Copy to clipboard" class="js-zeroclipboard minibutton zeroclipboard-button" data-copied-hint="Copied!" type="button"><span class="octicon octicon-clippy"></span></button>
    </span>
  </div>
</div>



<p class="clone-options">You can clone with
  <a href="#" class="js-clone-selector" data-protocol="http">HTTPS</a>, <a href="#" class="js-clone-selector" data-protocol="ssh">SSH</a>, or <a href="#" class="js-clone-selector" data-protocol="subversion">Subversion</a>.
  <a href="https://help.github.com/articles/which-remote-url-should-i-use" class="help tooltipped tooltipped-n" aria-label="Get help on which URL is right for you.">
    <span class="octicon octicon-question"></span>
  </a>
</p>


  <a href="http://windows.github.com" class="minibutton sidebar-button" title="Save jasonjoh/php-calendar to your computer and use it in GitHub Desktop." aria-label="Save jasonjoh/php-calendar to your computer and use it in GitHub Desktop.">
    <span class="octicon octicon-device-desktop"></span>
    Clone in Desktop
  </a>

                <a href="/jasonjoh/php-calendar/archive/master.zip"
                   class="minibutton sidebar-button"
                   aria-label="Download the contents of jasonjoh/php-calendar as a zip file"
                   title="Download the contents of jasonjoh/php-calendar as a zip file"
                   rel="nofollow">
                  <span class="octicon octicon-cloud-download"></span>
                  Download ZIP
                </a>
              </div>
        </div><!-- /.repository-sidebar -->

        <div id="js-repo-pjax-container" class="repository-content context-loader-container" data-pjax-container>
          

<a href="/jasonjoh/php-calendar/blob/6c91304313daf1672cb64c02af079b6b3ed29b01/o365/authorize.php" class="hidden js-permalink-shortcut" data-hotkey="y">Permalink</a>

<!-- blob contrib key: blob_contributors:v21:92dd0ef17649c26dfe65250a7e3839f3 -->

<div class="file-navigation js-zeroclipboard-container">
  
<div class="select-menu js-menu-container js-select-menu left">
  <span class="minibutton select-menu-button js-menu-target css-truncate" data-hotkey="w"
    data-master-branch="master"
    data-ref="master"
    title="master"
    role="button" aria-label="Switch branches or tags" tabindex="0" aria-haspopup="true">
    <span class="octicon octicon-git-branch"></span>
    <i>branch:</i>
    <span class="js-select-button css-truncate-target">master</span>
  </span>

  <div class="select-menu-modal-holder js-menu-content js-navigation-container" data-pjax aria-hidden="true">

    <div class="select-menu-modal">
      <div class="select-menu-header">
        <span class="select-menu-title">Switch branches/tags</span>
        <span class="octicon octicon-x js-menu-close" role="button" aria-label="Close"></span>
      </div>

      <div class="select-menu-filters">
        <div class="select-menu-text-filter">
          <input type="text" aria-label="Filter branches/tags" id="context-commitish-filter-field" class="js-filterable-field js-navigation-enable" placeholder="Filter branches/tags">
        </div>
        <div class="select-menu-tabs">
          <ul>
            <li class="select-menu-tab">
              <a href="#" data-tab-filter="branches" data-filter-placeholder="Filter branches/tags" class="js-select-menu-tab">Branches</a>
            </li>
            <li class="select-menu-tab">
              <a href="#" data-tab-filter="tags" data-filter-placeholder="Find a tag…" class="js-select-menu-tab">Tags</a>
            </li>
          </ul>
        </div>
      </div>

      <div class="select-menu-list select-menu-tab-bucket js-select-menu-tab-bucket" data-tab-filter="branches">

        <div data-filterable-for="context-commitish-filter-field" data-filterable-type="substring">


            <a class="select-menu-item js-navigation-item js-navigation-open selected"
               href="/jasonjoh/php-calendar/blob/master/o365/authorize.php"
               data-name="master"
               data-skip-pjax="true"
               rel="nofollow">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <span class="select-menu-item-text css-truncate-target" title="master">
                master
              </span>
            </a>
        </div>

          <div class="select-menu-no-results">Nothing to show</div>
      </div>

      <div class="select-menu-list select-menu-tab-bucket js-select-menu-tab-bucket" data-tab-filter="tags">
        <div data-filterable-for="context-commitish-filter-field" data-filterable-type="substring">


        </div>

        <div class="select-menu-no-results">Nothing to show</div>
      </div>

    </div>
  </div>
</div>

  <div class="button-group right">
    <a href="/jasonjoh/php-calendar/find/master"
          class="js-show-file-finder minibutton empty-icon tooltipped tooltipped-s"
          data-pjax
          data-hotkey="t"
          aria-label="Quickly jump between files">
      <span class="octicon octicon-list-unordered"></span>
    </a>
    <button aria-label="Copy file path to clipboard" class="js-zeroclipboard minibutton zeroclipboard-button" data-copied-hint="Copied!" type="button"><span class="octicon octicon-clippy"></span></button>
  </div>

  <div class="breadcrumb js-zeroclipboard-target">
    <span class='repo-root js-repo-root'><span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="/jasonjoh/php-calendar" class="" data-branch="master" data-direction="back" data-pjax="true" itemscope="url"><span itemprop="title">php-calendar</span></a></span></span><span class="separator">/</span><span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="/jasonjoh/php-calendar/tree/master/o365" class="" data-branch="master" data-direction="back" data-pjax="true" itemscope="url"><span itemprop="title">o365</span></a></span><span class="separator">/</span><strong class="final-path">authorize.php</strong>
  </div>
</div>


  <div class="commit file-history-tease">
    <div class="file-history-tease-header">
        <img alt="Jason Johnston" class="avatar" data-user="8966342" height="24" src="https://avatars1.githubusercontent.com/u/8966342?v=3&amp;s=48" width="24" />
        <span class="author"><a href="/jasonjoh" rel="author">jasonjoh</a></span>
        <time datetime="2015-02-24T19:37:04Z" is="relative-time">Feb 24, 2015</time>
        <div class="commit-title">
            <a href="/jasonjoh/php-calendar/commit/7887d25f29897f04de1e666a39475cbd31ae1743" class="message" data-pjax="true" title="Got token refresh working">Got token refresh working</a>
        </div>
    </div>

    <div class="participation">
      <p class="quickstat">
        <a href="#blob_contributors_box" rel="facebox">
          <strong>1</strong>
           contributor
        </a>
      </p>
      
    </div>
    <div id="blob_contributors_box" style="display:none">
      <h2 class="facebox-header">Users who have contributed to this file</h2>
      <ul class="facebox-user-list">
          <li class="facebox-user-list-item">
            <img alt="Jason Johnston" data-user="8966342" height="24" src="https://avatars1.githubusercontent.com/u/8966342?v=3&amp;s=48" width="24" />
            <a href="/jasonjoh">jasonjoh</a>
          </li>
      </ul>
    </div>
  </div>

<div class="file">
  <div class="file-header">
    <div class="file-info">
        74 lines (64 sloc)
        <span class="file-info-divider"></span>
      3.203 kb
    </div>
    <div class="file-actions">
      <div class="button-group">
        <a href="/jasonjoh/php-calendar/raw/master/o365/authorize.php" class="minibutton " id="raw-url">Raw</a>
          <a href="/jasonjoh/php-calendar/blame/master/o365/authorize.php" class="minibutton js-update-url-with-hash">Blame</a>
        <a href="/jasonjoh/php-calendar/commits/master/o365/authorize.php" class="minibutton " rel="nofollow">History</a>
      </div><!-- /.button-group -->

        <a class="octicon-button tooltipped tooltipped-nw"
           href="http://windows.github.com" aria-label="Open this file in GitHub for Windows">
            <span class="octicon octicon-device-desktop"></span>
        </a>

            <a class="octicon-button tooltipped tooltipped-n js-update-url-with-hash"
               aria-label="Clicking this button will fork this project so you can edit the file"
               href="/jasonjoh/php-calendar/edit/master/o365/authorize.php"
               data-method="post" rel="nofollow"><span class="octicon octicon-pencil"></span></a>

          <a class="octicon-button danger tooltipped tooltipped-s"
             href="/jasonjoh/php-calendar/delete/master/o365/authorize.php"
             aria-label="Fork this project and delete file"
             data-method="post" data-test-id="delete-blob-file" rel="nofollow">
        <span class="octicon octicon-trashcan"></span>
      </a>
    </div><!-- /.actions -->
  </div>
  
  <div class="blob-wrapper data type-php">
      <table class="highlight tab-size-8 js-file-line-container">
      <tr>
        <td id="L1" class="blob-num js-line-number" data-line-number="1"></td>
        <td id="LC1" class="blob-code js-file-line"><span class="pl-pse">&lt;?php</span><span class="pl-s2"></span></td>
      </tr>
      <tr>
        <td id="L2" class="blob-num js-line-number" data-line-number="2"></td>
        <td id="LC2" class="blob-code js-file-line"><span class="pl-s2"><span class="pl-c">// Copyright (c) Microsoft. All rights reserved. Licensed under the MIT license. See full license at the bottom of this file.</span></span></td>
      </tr>
      <tr>
        <td id="L3" class="blob-num js-line-number" data-line-number="3"></td>
        <td id="LC3" class="blob-code js-file-line"><span class="pl-s2"></span></td>
      </tr>
      <tr>
        <td id="L4" class="blob-num js-line-number" data-line-number="4"></td>
        <td id="LC4" class="blob-code js-file-line"><span class="pl-s2"><span class="pl-c">// This file serves as the redirect target for the first part of the auth code grant flow.</span></span></td>
      </tr>
      <tr>
        <td id="L5" class="blob-num js-line-number" data-line-number="5"></td>
        <td id="LC5" class="blob-code js-file-line"><span class="pl-s2"><span class="pl-c">// The user is directed to the Azure login site, and once they login, they are redirected here.</span></span></td>
      </tr>
      <tr>
        <td id="L6" class="blob-num js-line-number" data-line-number="6"></td>
        <td id="LC6" class="blob-code js-file-line"><span class="pl-s2"><span class="pl-s3">session_start</span>(); </span></td>
      </tr>
      <tr>
        <td id="L7" class="blob-num js-line-number" data-line-number="7"></td>
        <td id="LC7" class="blob-code js-file-line"><span class="pl-s2"><span class="pl-k">require_once</span>(<span class="pl-s1"><span class="pl-pds">&#39;</span>Office365Service.php<span class="pl-pds">&#39;</span></span>);</span></td>
      </tr>
      <tr>
        <td id="L8" class="blob-num js-line-number" data-line-number="8"></td>
        <td id="LC8" class="blob-code js-file-line"><span class="pl-s2"><span class="pl-c">// Get the &#39;code&#39; and &#39;session_state&#39; parameters from</span></span></td>
      </tr>
      <tr>
        <td id="L9" class="blob-num js-line-number" data-line-number="9"></td>
        <td id="LC9" class="blob-code js-file-line"><span class="pl-s2"><span class="pl-c">// the GET request</span></span></td>
      </tr>
      <tr>
        <td id="L10" class="blob-num js-line-number" data-line-number="10"></td>
        <td id="LC10" class="blob-code js-file-line"><span class="pl-s2"><span class="pl-vo">$code</span> <span class="pl-k">=</span> <span class="pl-vo">$_GET</span>[<span class="pl-s1"><span class="pl-pds">&#39;</span>code<span class="pl-pds">&#39;</span></span>];</span></td>
      </tr>
      <tr>
        <td id="L11" class="blob-num js-line-number" data-line-number="11"></td>
        <td id="LC11" class="blob-code js-file-line"><span class="pl-s2"><span class="pl-vo">$session_state</span> <span class="pl-k">=</span> <span class="pl-vo">$_GET</span>[<span class="pl-s1"><span class="pl-pds">&#39;</span>session_state<span class="pl-pds">&#39;</span></span>];</span></td>
      </tr>
      <tr>
        <td id="L12" class="blob-num js-line-number" data-line-number="12"></td>
        <td id="LC12" class="blob-code js-file-line"><span class="pl-s2"></span></td>
      </tr>
      <tr>
        <td id="L13" class="blob-num js-line-number" data-line-number="13"></td>
        <td id="LC13" class="blob-code js-file-line"><span class="pl-s2"><span class="pl-vo">$errorPage</span> <span class="pl-k">=</span> <span class="pl-s1"><span class="pl-pds">&quot;</span>http<span class="pl-pds">&quot;</span></span><span class="pl-k">.</span>((<span class="pl-vo">$_SERVER</span>[<span class="pl-s1"><span class="pl-pds">&quot;</span>HTTPS<span class="pl-pds">&quot;</span></span>] <span class="pl-k">==</span> <span class="pl-s1"><span class="pl-pds">&quot;</span>on<span class="pl-pds">&quot;</span></span>) ? <span class="pl-s1"><span class="pl-pds">&quot;</span>s://<span class="pl-pds">&quot;</span></span> : <span class="pl-s1"><span class="pl-pds">&quot;</span>://<span class="pl-pds">&quot;</span></span>)<span class="pl-k">.</span><span class="pl-vo">$_SERVER</span>[<span class="pl-s1"><span class="pl-pds">&quot;</span>HTTP_HOST<span class="pl-pds">&quot;</span></span>]<span class="pl-k">.</span><span class="pl-s1"><span class="pl-pds">&quot;</span>/php-calendar/error.php<span class="pl-pds">&quot;</span></span>; </span></td>
      </tr>
      <tr>
        <td id="L14" class="blob-num js-line-number" data-line-number="14"></td>
        <td id="LC14" class="blob-code js-file-line"><span class="pl-s2"></span></td>
      </tr>
      <tr>
        <td id="L15" class="blob-num js-line-number" data-line-number="15"></td>
        <td id="LC15" class="blob-code js-file-line"><span class="pl-s2"><span class="pl-k">if</span> (<span class="pl-s3">is_null</span>(<span class="pl-vo">$code</span>)) {</span></td>
      </tr>
      <tr>
        <td id="L16" class="blob-num js-line-number" data-line-number="16"></td>
        <td id="LC16" class="blob-code js-file-line"><span class="pl-s2">  <span class="pl-c">// Display error </span></span></td>
      </tr>
      <tr>
        <td id="L17" class="blob-num js-line-number" data-line-number="17"></td>
        <td id="LC17" class="blob-code js-file-line"><span class="pl-s2">  <span class="pl-vo">$msg</span> <span class="pl-k">=</span> <span class="pl-s1"><span class="pl-pds">&quot;</span>There was no &#39;code&#39; parameter in the query string.<span class="pl-pds">&quot;</span></span>;</span></td>
      </tr>
      <tr>
        <td id="L18" class="blob-num js-line-number" data-line-number="18"></td>
        <td id="LC18" class="blob-code js-file-line"><span class="pl-s2">  <span class="pl-s3">error_log</span>(<span class="pl-vo">$msg</span>);</span></td>
      </tr>
      <tr>
        <td id="L19" class="blob-num js-line-number" data-line-number="19"></td>
        <td id="LC19" class="blob-code js-file-line"><span class="pl-s2">  <span class="pl-s3">header</span>(<span class="pl-s1"><span class="pl-pds">&quot;</span>Location: <span class="pl-pds">&quot;</span></span><span class="pl-k">.</span><span class="pl-vo">$errorPage</span><span class="pl-k">.</span><span class="pl-s1"><span class="pl-pds">&quot;</span>?errorMsg=<span class="pl-pds">&quot;</span></span><span class="pl-k">.</span><span class="pl-s3">urlencode</span>(<span class="pl-vo">$msg</span>));</span></td>
      </tr>
      <tr>
        <td id="L20" class="blob-num js-line-number" data-line-number="20"></td>
        <td id="LC20" class="blob-code js-file-line"><span class="pl-s2">  <span class="pl-k">exit</span>;</span></td>
      </tr>
      <tr>
        <td id="L21" class="blob-num js-line-number" data-line-number="21"></td>
        <td id="LC21" class="blob-code js-file-line"><span class="pl-s2">}</span></td>
      </tr>
      <tr>
        <td id="L22" class="blob-num js-line-number" data-line-number="22"></td>
        <td id="LC22" class="blob-code js-file-line"><span class="pl-s2"><span class="pl-k">else</span> {</span></td>
      </tr>
      <tr>
        <td id="L23" class="blob-num js-line-number" data-line-number="23"></td>
        <td id="LC23" class="blob-code js-file-line"><span class="pl-s2">  <span class="pl-s3">error_log</span>(<span class="pl-s1"><span class="pl-pds">&quot;</span>authorize.php called with code: <span class="pl-pds">&quot;</span></span><span class="pl-k">.</span><span class="pl-vo">$code</span>);</span></td>
      </tr>
      <tr>
        <td id="L24" class="blob-num js-line-number" data-line-number="24"></td>
        <td id="LC24" class="blob-code js-file-line"><span class="pl-s2">  <span class="pl-vo">$redirectUri</span> <span class="pl-k">=</span> <span class="pl-s1"><span class="pl-pds">&quot;</span>http<span class="pl-pds">&quot;</span></span><span class="pl-k">.</span>((<span class="pl-vo">$_SERVER</span>[<span class="pl-s1"><span class="pl-pds">&quot;</span>HTTPS<span class="pl-pds">&quot;</span></span>] <span class="pl-k">==</span> <span class="pl-s1"><span class="pl-pds">&quot;</span>on<span class="pl-pds">&quot;</span></span>) ? <span class="pl-s1"><span class="pl-pds">&quot;</span>s://<span class="pl-pds">&quot;</span></span> : <span class="pl-s1"><span class="pl-pds">&quot;</span>://<span class="pl-pds">&quot;</span></span>)<span class="pl-k">.</span><span class="pl-vo">$_SERVER</span>[<span class="pl-s1"><span class="pl-pds">&quot;</span>HTTP_HOST<span class="pl-pds">&quot;</span></span>]<span class="pl-k">.</span><span class="pl-s1"><span class="pl-pds">&quot;</span>/php-calendar/o365/authorize.php<span class="pl-pds">&quot;</span></span>; </span></td>
      </tr>
      <tr>
        <td id="L25" class="blob-num js-line-number" data-line-number="25"></td>
        <td id="LC25" class="blob-code js-file-line"><span class="pl-s2">  </span></td>
      </tr>
      <tr>
        <td id="L26" class="blob-num js-line-number" data-line-number="26"></td>
        <td id="LC26" class="blob-code js-file-line"><span class="pl-s2">  <span class="pl-s3">error_log</span>(<span class="pl-s1"><span class="pl-pds">&quot;</span>Calling getTokenFromAuthCode<span class="pl-pds">&quot;</span></span>);</span></td>
      </tr>
      <tr>
        <td id="L27" class="blob-num js-line-number" data-line-number="27"></td>
        <td id="LC27" class="blob-code js-file-line"><span class="pl-s2">  <span class="pl-c">// Use the code supplied by Azure to request an access token.</span></span></td>
      </tr>
      <tr>
        <td id="L28" class="blob-num js-line-number" data-line-number="28"></td>
        <td id="LC28" class="blob-code js-file-line"><span class="pl-s2">  <span class="pl-vo">$tokens</span> <span class="pl-k">=</span> <span class="pl-s3">Office365Service</span><span class="pl-k">::</span>getTokenFromAuthCode(<span class="pl-vo">$code</span>, <span class="pl-vo">$redirectUri</span>);</span></td>
      </tr>
      <tr>
        <td id="L29" class="blob-num js-line-number" data-line-number="29"></td>
        <td id="LC29" class="blob-code js-file-line"><span class="pl-s2">  <span class="pl-k">if</span> (<span class="pl-vo">$tokens</span>[<span class="pl-s1"><span class="pl-pds">&#39;</span>access_token<span class="pl-pds">&#39;</span></span>]) {</span></td>
      </tr>
      <tr>
        <td id="L30" class="blob-num js-line-number" data-line-number="30"></td>
        <td id="LC30" class="blob-code js-file-line"><span class="pl-s2">    <span class="pl-s3">error_log</span>(<span class="pl-s1"><span class="pl-pds">&quot;</span>getTokenFromAuthCode returned:<span class="pl-pds">&quot;</span></span>);</span></td>
      </tr>
      <tr>
        <td id="L31" class="blob-num js-line-number" data-line-number="31"></td>
        <td id="LC31" class="blob-code js-file-line"><span class="pl-s2">    <span class="pl-s3">error_log</span>(<span class="pl-s1"><span class="pl-pds">&quot;</span>  access_token: <span class="pl-pds">&quot;</span></span><span class="pl-k">.</span><span class="pl-vo">$tokens</span>[<span class="pl-s1"><span class="pl-pds">&#39;</span>access_token<span class="pl-pds">&#39;</span></span>]);</span></td>
      </tr>
      <tr>
        <td id="L32" class="blob-num js-line-number" data-line-number="32"></td>
        <td id="LC32" class="blob-code js-file-line"><span class="pl-s2">    <span class="pl-s3">error_log</span>(<span class="pl-s1"><span class="pl-pds">&quot;</span>  refresh_token: <span class="pl-pds">&quot;</span></span><span class="pl-k">.</span><span class="pl-vo">$tokens</span>[<span class="pl-s1"><span class="pl-pds">&#39;</span>refresh_token<span class="pl-pds">&#39;</span></span>]);</span></td>
      </tr>
      <tr>
        <td id="L33" class="blob-num js-line-number" data-line-number="33"></td>
        <td id="LC33" class="blob-code js-file-line"><span class="pl-s2">    </span></td>
      </tr>
      <tr>
        <td id="L34" class="blob-num js-line-number" data-line-number="34"></td>
        <td id="LC34" class="blob-code js-file-line"><span class="pl-s2">    <span class="pl-c">// Save the access token and refresh token to the session.</span></span></td>
      </tr>
      <tr>
        <td id="L35" class="blob-num js-line-number" data-line-number="35"></td>
        <td id="LC35" class="blob-code js-file-line"><span class="pl-s2">    <span class="pl-vo">$_SESSION</span>[<span class="pl-s1"><span class="pl-pds">&#39;</span>accessToken<span class="pl-pds">&#39;</span></span>] <span class="pl-k">=</span> <span class="pl-vo">$tokens</span>[<span class="pl-s1"><span class="pl-pds">&#39;</span>access_token<span class="pl-pds">&#39;</span></span>];</span></td>
      </tr>
      <tr>
        <td id="L36" class="blob-num js-line-number" data-line-number="36"></td>
        <td id="LC36" class="blob-code js-file-line"><span class="pl-s2">    <span class="pl-vo">$_SESSION</span>[<span class="pl-s1"><span class="pl-pds">&#39;</span>refreshToken<span class="pl-pds">&#39;</span></span>] <span class="pl-k">=</span> <span class="pl-vo">$tokens</span>[<span class="pl-s1"><span class="pl-pds">&#39;</span>refresh_token<span class="pl-pds">&#39;</span></span>];</span></td>
      </tr>
      <tr>
        <td id="L37" class="blob-num js-line-number" data-line-number="37"></td>
        <td id="LC37" class="blob-code js-file-line"><span class="pl-s2">    <span class="pl-c">// Parse the id token returned in the response to get the user name.</span></span></td>
      </tr>
      <tr>
        <td id="L38" class="blob-num js-line-number" data-line-number="38"></td>
        <td id="LC38" class="blob-code js-file-line"><span class="pl-s2">    <span class="pl-vo">$_SESSION</span>[<span class="pl-s1"><span class="pl-pds">&#39;</span>userName<span class="pl-pds">&#39;</span></span>] <span class="pl-k">=</span> <span class="pl-s3">Office365Service</span><span class="pl-k">::</span>getUserName(<span class="pl-vo">$tokens</span>[<span class="pl-s1"><span class="pl-pds">&#39;</span>id_token<span class="pl-pds">&#39;</span></span>]);</span></td>
      </tr>
      <tr>
        <td id="L39" class="blob-num js-line-number" data-line-number="39"></td>
        <td id="LC39" class="blob-code js-file-line"><span class="pl-s2"></span></td>
      </tr>
      <tr>
        <td id="L40" class="blob-num js-line-number" data-line-number="40"></td>
        <td id="LC40" class="blob-code js-file-line"><span class="pl-s2">    <span class="pl-c">// Redirect back to the homepage.</span></span></td>
      </tr>
      <tr>
        <td id="L41" class="blob-num js-line-number" data-line-number="41"></td>
        <td id="LC41" class="blob-code js-file-line"><span class="pl-s2">    <span class="pl-vo">$homePage</span> <span class="pl-k">=</span> <span class="pl-s1"><span class="pl-pds">&quot;</span>http<span class="pl-pds">&quot;</span></span><span class="pl-k">.</span>((<span class="pl-vo">$_SERVER</span>[<span class="pl-s1"><span class="pl-pds">&quot;</span>HTTPS<span class="pl-pds">&quot;</span></span>] <span class="pl-k">==</span> <span class="pl-s1"><span class="pl-pds">&quot;</span>on<span class="pl-pds">&quot;</span></span>) ? <span class="pl-s1"><span class="pl-pds">&quot;</span>s://<span class="pl-pds">&quot;</span></span> : <span class="pl-s1"><span class="pl-pds">&quot;</span>://<span class="pl-pds">&quot;</span></span>)<span class="pl-k">.</span><span class="pl-vo">$_SERVER</span>[<span class="pl-s1"><span class="pl-pds">&quot;</span>HTTP_HOST<span class="pl-pds">&quot;</span></span>]<span class="pl-k">.</span><span class="pl-s1"><span class="pl-pds">&quot;</span>/php-calendar/home.php<span class="pl-pds">&quot;</span></span>; </span></td>
      </tr>
      <tr>
        <td id="L42" class="blob-num js-line-number" data-line-number="42"></td>
        <td id="LC42" class="blob-code js-file-line"><span class="pl-s2">    <span class="pl-s3">header</span>(<span class="pl-s1"><span class="pl-pds">&quot;</span>Location: <span class="pl-pds">&quot;</span></span><span class="pl-k">.</span><span class="pl-vo">$homePage</span>);</span></td>
      </tr>
      <tr>
        <td id="L43" class="blob-num js-line-number" data-line-number="43"></td>
        <td id="LC43" class="blob-code js-file-line"><span class="pl-s2">    <span class="pl-k">exit</span>;</span></td>
      </tr>
      <tr>
        <td id="L44" class="blob-num js-line-number" data-line-number="44"></td>
        <td id="LC44" class="blob-code js-file-line"><span class="pl-s2">  }</span></td>
      </tr>
      <tr>
        <td id="L45" class="blob-num js-line-number" data-line-number="45"></td>
        <td id="LC45" class="blob-code js-file-line"><span class="pl-s2">  <span class="pl-k">else</span> {</span></td>
      </tr>
      <tr>
        <td id="L46" class="blob-num js-line-number" data-line-number="46"></td>
        <td id="LC46" class="blob-code js-file-line"><span class="pl-s2">    <span class="pl-vo">$msg</span> <span class="pl-k">=</span> <span class="pl-s1"><span class="pl-pds">&quot;</span>Error retrieving access token: <span class="pl-pds">&quot;</span></span><span class="pl-k">.</span><span class="pl-vo">$tokens</span>[<span class="pl-s1"><span class="pl-pds">&#39;</span>error<span class="pl-pds">&#39;</span></span>];</span></td>
      </tr>
      <tr>
        <td id="L47" class="blob-num js-line-number" data-line-number="47"></td>
        <td id="LC47" class="blob-code js-file-line"><span class="pl-s2">    <span class="pl-s3">error_log</span>(<span class="pl-vo">$msg</span>);</span></td>
      </tr>
      <tr>
        <td id="L48" class="blob-num js-line-number" data-line-number="48"></td>
        <td id="LC48" class="blob-code js-file-line"><span class="pl-s2">    <span class="pl-s3">header</span>(<span class="pl-s1"><span class="pl-pds">&quot;</span>Location: <span class="pl-pds">&quot;</span></span><span class="pl-k">.</span><span class="pl-vo">$errorPage</span><span class="pl-k">.</span><span class="pl-s1"><span class="pl-pds">&quot;</span>?errorMsg=<span class="pl-pds">&quot;</span></span><span class="pl-k">.</span><span class="pl-s3">urlencode</span>(<span class="pl-vo">$msg</span>));</span></td>
      </tr>
      <tr>
        <td id="L49" class="blob-num js-line-number" data-line-number="49"></td>
        <td id="LC49" class="blob-code js-file-line"><span class="pl-s2">  }</span></td>
      </tr>
      <tr>
        <td id="L50" class="blob-num js-line-number" data-line-number="50"></td>
        <td id="LC50" class="blob-code js-file-line"><span class="pl-s2">}</span></td>
      </tr>
      <tr>
        <td id="L51" class="blob-num js-line-number" data-line-number="51"></td>
        <td id="LC51" class="blob-code js-file-line"><span class="pl-s2"></span></td>
      </tr>
      <tr>
        <td id="L52" class="blob-num js-line-number" data-line-number="52"></td>
        <td id="LC52" class="blob-code js-file-line"><span class="pl-s2"><span class="pl-c">/*</span></span></td>
      </tr>
      <tr>
        <td id="L53" class="blob-num js-line-number" data-line-number="53"></td>
        <td id="LC53" class="blob-code js-file-line"><span class="pl-s2"><span class="pl-c"> MIT License: </span></span></td>
      </tr>
      <tr>
        <td id="L54" class="blob-num js-line-number" data-line-number="54"></td>
        <td id="LC54" class="blob-code js-file-line"><span class="pl-s2"><span class="pl-c"> </span></span></td>
      </tr>
      <tr>
        <td id="L55" class="blob-num js-line-number" data-line-number="55"></td>
        <td id="LC55" class="blob-code js-file-line"><span class="pl-s2"><span class="pl-c"> Permission is hereby granted, free of charge, to any person obtaining </span></span></td>
      </tr>
      <tr>
        <td id="L56" class="blob-num js-line-number" data-line-number="56"></td>
        <td id="LC56" class="blob-code js-file-line"><span class="pl-s2"><span class="pl-c"> a copy of this software and associated documentation files (the </span></span></td>
      </tr>
      <tr>
        <td id="L57" class="blob-num js-line-number" data-line-number="57"></td>
        <td id="LC57" class="blob-code js-file-line"><span class="pl-s2"><span class="pl-c"> &quot;&quot;Software&quot;&quot;), to deal in the Software without restriction, including </span></span></td>
      </tr>
      <tr>
        <td id="L58" class="blob-num js-line-number" data-line-number="58"></td>
        <td id="LC58" class="blob-code js-file-line"><span class="pl-s2"><span class="pl-c"> without limitation the rights to use, copy, modify, merge, publish, </span></span></td>
      </tr>
      <tr>
        <td id="L59" class="blob-num js-line-number" data-line-number="59"></td>
        <td id="LC59" class="blob-code js-file-line"><span class="pl-s2"><span class="pl-c"> distribute, sublicense, and/or sell copies of the Software, and to </span></span></td>
      </tr>
      <tr>
        <td id="L60" class="blob-num js-line-number" data-line-number="60"></td>
        <td id="LC60" class="blob-code js-file-line"><span class="pl-s2"><span class="pl-c"> permit persons to whom the Software is furnished to do so, subject to </span></span></td>
      </tr>
      <tr>
        <td id="L61" class="blob-num js-line-number" data-line-number="61"></td>
        <td id="LC61" class="blob-code js-file-line"><span class="pl-s2"><span class="pl-c"> the following conditions: </span></span></td>
      </tr>
      <tr>
        <td id="L62" class="blob-num js-line-number" data-line-number="62"></td>
        <td id="LC62" class="blob-code js-file-line"><span class="pl-s2"><span class="pl-c"> </span></span></td>
      </tr>
      <tr>
        <td id="L63" class="blob-num js-line-number" data-line-number="63"></td>
        <td id="LC63" class="blob-code js-file-line"><span class="pl-s2"><span class="pl-c"> The above copyright notice and this permission notice shall be </span></span></td>
      </tr>
      <tr>
        <td id="L64" class="blob-num js-line-number" data-line-number="64"></td>
        <td id="LC64" class="blob-code js-file-line"><span class="pl-s2"><span class="pl-c"> included in all copies or substantial portions of the Software. </span></span></td>
      </tr>
      <tr>
        <td id="L65" class="blob-num js-line-number" data-line-number="65"></td>
        <td id="LC65" class="blob-code js-file-line"><span class="pl-s2"><span class="pl-c"> </span></span></td>
      </tr>
      <tr>
        <td id="L66" class="blob-num js-line-number" data-line-number="66"></td>
        <td id="LC66" class="blob-code js-file-line"><span class="pl-s2"><span class="pl-c"> THE SOFTWARE IS PROVIDED &quot;&quot;AS IS&quot;&quot;, WITHOUT WARRANTY OF ANY KIND, </span></span></td>
      </tr>
      <tr>
        <td id="L67" class="blob-num js-line-number" data-line-number="67"></td>
        <td id="LC67" class="blob-code js-file-line"><span class="pl-s2"><span class="pl-c"> EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF </span></span></td>
      </tr>
      <tr>
        <td id="L68" class="blob-num js-line-number" data-line-number="68"></td>
        <td id="LC68" class="blob-code js-file-line"><span class="pl-s2"><span class="pl-c"> MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND </span></span></td>
      </tr>
      <tr>
        <td id="L69" class="blob-num js-line-number" data-line-number="69"></td>
        <td id="LC69" class="blob-code js-file-line"><span class="pl-s2"><span class="pl-c"> NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE </span></span></td>
      </tr>
      <tr>
        <td id="L70" class="blob-num js-line-number" data-line-number="70"></td>
        <td id="LC70" class="blob-code js-file-line"><span class="pl-s2"><span class="pl-c"> LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION </span></span></td>
      </tr>
      <tr>
        <td id="L71" class="blob-num js-line-number" data-line-number="71"></td>
        <td id="LC71" class="blob-code js-file-line"><span class="pl-s2"><span class="pl-c"> OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION </span></span></td>
      </tr>
      <tr>
        <td id="L72" class="blob-num js-line-number" data-line-number="72"></td>
        <td id="LC72" class="blob-code js-file-line"><span class="pl-s2"><span class="pl-c"> WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.</span></span></td>
      </tr>
      <tr>
        <td id="L73" class="blob-num js-line-number" data-line-number="73"></td>
        <td id="LC73" class="blob-code js-file-line"><span class="pl-s2"><span class="pl-c">*/</span></span></td>
      </tr>
      <tr>
        <td id="L74" class="blob-num js-line-number" data-line-number="74"></td>
        <td id="LC74" class="blob-code js-file-line"><span class="pl-s2"></span><span class="pl-pse"><span class="pl-s2">?</span>&gt;</span></td>
      </tr>
</table>

  </div>

</div>

<a href="#jump-to-line" rel="facebox[.linejump]" data-hotkey="l" style="display:none">Jump to Line</a>
<div id="jump-to-line" style="display:none">
  <form accept-charset="UTF-8" class="js-jump-to-line-form">
    <input class="linejump-input js-jump-to-line-field" type="text" placeholder="Jump to line&hellip;" autofocus>
    <button type="submit" class="button">Go</button>
  </form>
</div>

        </div>

      </div><!-- /.repo-container -->
      <div class="modal-backdrop"></div>
    </div><!-- /.container -->
  </div><!-- /.site -->


    </div><!-- /.wrapper -->

      <div class="container">
  <div class="site-footer" role="contentinfo">
    <ul class="site-footer-links right">
        <li><a href="https://status.github.com/" data-ga-click="Footer, go to status, text:status">Status</a></li>
      <li><a href="https://developer.github.com" data-ga-click="Footer, go to api, text:api">API</a></li>
      <li><a href="http://training.github.com" data-ga-click="Footer, go to training, text:training">Training</a></li>
      <li><a href="http://shop.github.com" data-ga-click="Footer, go to shop, text:shop">Shop</a></li>
        <li><a href="/blog" data-ga-click="Footer, go to blog, text:blog">Blog</a></li>
        <li><a href="/about" data-ga-click="Footer, go to about, text:about">About</a></li>

    </ul>

    <a href="/" aria-label="Homepage">
      <span class="mega-octicon octicon-mark-github" title="GitHub"></span>
    </a>

    <ul class="site-footer-links">
      <li>&copy; 2015 <span title="0.05129s from github-fe119-cp1-prd.iad.github.net">GitHub</span>, Inc.</li>
        <li><a href="/site/terms" data-ga-click="Footer, go to terms, text:terms">Terms</a></li>
        <li><a href="/site/privacy" data-ga-click="Footer, go to privacy, text:privacy">Privacy</a></li>
        <li><a href="/security" data-ga-click="Footer, go to security, text:security">Security</a></li>
        <li><a href="/contact" data-ga-click="Footer, go to contact, text:contact">Contact</a></li>
    </ul>
  </div>
</div>


    <div class="fullscreen-overlay js-fullscreen-overlay" id="fullscreen_overlay">
  <div class="fullscreen-container js-suggester-container">
    <div class="textarea-wrap">
      <textarea name="fullscreen-contents" id="fullscreen-contents" class="fullscreen-contents js-fullscreen-contents" placeholder=""></textarea>
      <div class="suggester-container">
        <div class="suggester fullscreen-suggester js-suggester js-navigation-container"></div>
      </div>
    </div>
  </div>
  <div class="fullscreen-sidebar">
    <a href="#" class="exit-fullscreen js-exit-fullscreen tooltipped tooltipped-w" aria-label="Exit Zen Mode">
      <span class="mega-octicon octicon-screen-normal"></span>
    </a>
    <a href="#" class="theme-switcher js-theme-switcher tooltipped tooltipped-w"
      aria-label="Switch themes">
      <span class="octicon octicon-color-mode"></span>
    </a>
  </div>
</div>



    

    <div id="ajax-error-message" class="flash flash-error">
      <span class="octicon octicon-alert"></span>
      <a href="#" class="octicon octicon-x flash-close js-ajax-error-dismiss" aria-label="Dismiss error"></a>
      Something went wrong with that request. Please try again.
    </div>


      <script crossorigin="anonymous" src="https://assets-cdn.github.com/assets/frameworks-58b6d3b83766eebd6a230370d045d01ffa68d84d6504f3d18660c9c43e53de4c.js"></script>
      <script async="async" crossorigin="anonymous" src="https://assets-cdn.github.com/assets/github-b6ee04bf0aae7db4ad709a0a4bcaaf64b4f6e132d17710706361c673e1e59451.js"></script>
      
      

  </body>
</html>

