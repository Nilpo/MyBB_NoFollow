<?php
/**
 @ Author: Robert Dunham
 @ Created: 07/31/09
 @ Version: 1.0
 @ Website: http://www.windowsscript.com/
 @ Contact: nilpo@windowsscript.com
*/

if(!defined("IN_MYBB"))
{
    die("You cannot directly access this file.");
}

$plugins->add_hook("member_profile_end", "NoFollow_run");

function NoFollow_info()
{
    return array(
        "name"        => "NoFollow Website Links",
        "description" => "Makes user's web site links NoFollow to preserve PageRank.",
        "website"     => "http://www.windowsscript.com/forums/",
        "author"      => "Robert Dunham",
        "authorsite"  => "http://www.nilpo.com",
        "version"     => "1.0",
        "guid"        => "7adf636666c6fb473c81d51ba1c61337"
    );
}

function NoFollow_activate()
{
	require MYBB_ROOT."/inc/adminfunctions_templates.php";
	find_replace_templatesets('postbit_www',
                              '#' . preg_quote(' target=') . '#',
                              ' rel="nofollow" target='
                              );
    rebuild_settings();
}

function NoFollow_deactivate()
{
	require MYBB_ROOT."/inc/adminfunctions_templates.php";
	find_replace_templatesets('postbit_www',
                              '#' . preg_quote(' rel="nofollow" target=') . '#i',
                              ' target=',
                              0
                              );
	rebuild_settings();
}

function NoFollow_run()
{
    global $website;
    // Make links NoFollow in User Profile page
    eval('$website = \'' . preg_replace('#'.preg_quote(' target=').'#i', ' rel="nofollow" target=', $website).'\';');
}
?>