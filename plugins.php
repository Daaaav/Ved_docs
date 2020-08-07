<?php
require('hyperlight.php');

define('N', 'n'); // Hook name
define('S', 's'); // Script name
define('F', 'f'); // Function name
define('D', 'd'); // Hook description
define('A', 'a'); // Variables passed as arguments
define('VA', 'va'); // Version added
define('VR', 'vr'); // Version removed

?><!DOCTYPE html>
<html>
<head>
<title>Ved plugins</title>
<style>
td, th {
	padding: 4px;
}
/*
body {
	background-color: pink;
}
*/
/* pre {
	border: 1px solid black;
	padding: 2px;
} */

a#page_plugins {
	font-weight: bold;
}
</style>
<link rel="stylesheet" type="text/css" href="colors/customizedstyle.css?020217" id="theme">
</head>
<body>
<?php include('links.php'); ?>
<h1>Ved plugins</h1>
<p>This page details how to install or develop plugins for Ved.</p>
<p>Last updated: <strong><?php echo date('l j F Y H:i (T)', filemtime('ved_docs/plugins.php')); /* previously getlastmod() */ ?></strong> (this is the last edit date of the file)</p>

<h2><a name="installing">How to install plugins</a></h2>
<p>The plugins folder can be found at:
<ul>
<li><tt>%appdata%\LOVE\ved\plugins\</tt> (Windows, source)</li>
<li><tt>%appdata%\ved\plugins\</tt> (Windows, .exe version)</li>
<li><tt>/Users/user/Library/Application Support/LOVE/ved/plugins/</tt> (Mac)</li>
<li><tt>~/.local/share/love/ved/plugins/</tt> (Linux)</li>
</ul>
To install a plugin, simply place the plugin in that folder, either as a .zip or as a folder. To disable an installed plugin, you don't have to remove it from the plugins folder, simply rename it to make the name start with a #.
</p>

<h2><a name="making">How to make plugins</a></h2>
<p>For an example of a plugin, check <a href="https://tolp2.nl/ved/plugindownloads/example_plugin.zip" target="_blank">example_plugin.zip</a> (1.1, now contains source edits). There's a technical documentation of Ved that can be found <a href="internals.php" target="_blank">here</a>. You'll probably need to look at Ved's code while developing the plugin, and you can find it at <a href="https://gitgud.io/Dav999/ved" target="_blank">the repository</a>. You can also unzip the .love (it's actually a zip).

<p>Ved is written in <a href="http://www.lua.org/manual/5.1/" target="_blank">Lua</a> and uses the <a href="https://love2d.org/" target="_blank">L&Ouml;VE framework</a>. So to be able to make plugins, it would help a lot to be familiar with that.
To start making a plugin, make a new folder for it in the plugins folder (see above). You can name it anything you want, but the name isn't shown inside Ved itself, instead, the name you specify in the info file (<tt>info.lua</tt>) is.
<tt>info.lua</tt> is a file inside your plugin folder, containing the name for your plugin, a description, author name, version number, the minimum version of Ved that is required for the plugin to work, and some other things.<br>An example for the info file can be found here: <a href="info.lua" target="_blank">info.lua</a></p>

<p>Next, to integrate the plugin with Ved, you can use hooks, or you can make the plugin edit Ved source code (see below). To use hooks, make a folder called <b>hooks</b> in your plugin folder.</p>

<h2><a name="hooks">Hooks</a></h2>
<p>Plugins can make use of hooks, which are specific points in the Ved code where plugin code can be run. For example, there is a hook that is called after displaying everything on the screen, so you can use that hook to display something related to your plugin.</p>
<table border="1">
<tr><th>Hook name</th><th>Script</th><th>Function</th><th>Description</th><th>Args</th><th>Added</th></tr><?php
$hooks = array(
	array(
		N => 'love_draw_end',
		S => 'main2',
		F => 'love.draw',
		D => 'This is called at the end of love.draw(), thus can be used to draw something after everything else has been drawn.',
		VA => 'a58'
	),
	array(
		N => 'love_load_start',
		S => 'main2',
		F => 'love.load',
		D => 'This is called at the start of love.load(), before the config file has even been loaded.<br><u>Before 1.3.3:</u> The compatibility layer for L&Ouml;VE 0.10.x will also not yet have been loaded, so be careful.',
		VA => 'a58'
	),
	array(
		N => 'love_load_end',
		S => 'main2',
		F => 'love.load',
		D => 'This is called at the end of love.load().',
		VA => 'a58'
	),
	array(
		N => 'love_update_start',
		S => 'main2',
		F => 'love.update',
		D => 'This is called at the start of love.update().',
		A => 'dt',
		VA => 'a58'
	),
	array(
		N => 'love_update_end',
		S => 'main2',
		F => 'love.update',
		D => 'This is called near the end of love.update().',
		A => 'dt',
		VA => 'a58'
	),
	array(
		N => 'love_keypressed_start',
		S => 'main2',
		F => 'love.keypressed',
		D => 'This is called at the start of love.keypressed(key).',
		A => 'key',
		VA => 'a58/a59'
	),
	array(
		N => 'love_keyreleased_start',
		S => 'main2',
		F => 'love.keyreleased',
		D => 'This is called at the start of love.keyreleased(key).',
		A => 'key',
		VA => 'a58/a59'
	),
	array(
		N => 'love_mousepressed_start',
		S => 'main2',
		F => 'love.mousepressed',
		D => 'This is called at the start of love.mousepressed(x, y, button).',
		A => 'x, y, button',
		VA => 'a58/a59'
	),
	array(
		N => 'love_mousereleased_start',
		S => 'main2',
		F => 'love.mousereleased',
		D => 'This is called at the start of love.mousereleased(x, y, button).',
		A => 'x, y, button',
		VA => 'a58/a59'
	),
	array(
		N => 'func',
		S => 'func',
		D => 'This is called at the end of the func.lua script, so you can add your own functions here.',
		VA => 'a58'
	),
	array(
		N => 'func_loadstate',
		S => 'func',
		F => 'loadstate, to_astate',
		D => 'This is called when going to a new state, so you can add code to prepare loading a custom state you may have added. Use <tt>in_astate(name, state)</tt> to check what the new state is (example: <tt>in_astate("my_1st_plug", 0)</tt>, see technical documentation).<br><u>Before 1.1.4:</u> The variable <tt>new</tt> contains the new state which is being loaded.',
		VA => 'a58/a59'
	),
	array(
		N => 'love_draw_state',
		S => 'main2',
		F => 'love.draw',
		D => 'Here you can add drawing code for custom states. Use <tt>in_astate(name, state)</tt> to check what the current state is, and if your code recognizes a state and handles it, it should set <tt>statecaught</tt> to true, so there will not be an error message saying the state wasn\'t recognized.<br><u>Before 1.1.4:</u> The <tt>state</tt> variable was used instead of <tt>in_astate()</tt>.',
		VA => 'a58'
	),
	array(
		N => 'love_load_win',
		S => 'main2',
		F => 'love.load',
		D => 'This is called in love.load() only if the operating system is Windows.',
		VA => 'b10'
	),
	array(
		N => 'love_load_mac',
		S => 'main2',
		F => 'love.load',
		D => 'This is called in love.load() only if the operating system is Mac OS X.',
		VA => 'b10'
	),
	array(
		N => 'love_load_lin',
		S => 'main2',
		F => 'love.load',
		D => 'This is called in love.load() only if the operating system is Linux.',
		VA => 'b10'
	),
	array(
		N => 'love_load_luv',
		S => 'main2',
		F => 'love.load',
		D => 'This is called in love.load() only if the operating system is something other than Windows, OS X or Linux.',
		VA => 'b10'
	),
	array(
		N => 'love_directorydropped',
		S => 'main2',
		F => 'love.directorydropped',
		D => 'This is called in love.directorydropped(path). Note that this was added in L&Ouml;VE 0.10.0, so in 0.9.x this hook will never be called.',
		A => 'path',
		VA => '1.4.3'
	),
	array(
		N => 'love_filedropped',
		S => 'main2',
		F => 'love.filedropped',
		D => 'This is called in love.filedropped(file). Note that this was added in L&Ouml;VE 0.10.0, so in 0.9.x this hook will never be called.',
		A => '<a href="https://love2d.org/wiki/DroppedFile" target="_blank">file</a>',
		VA => '1.4.3'
	),
	array(
		N => 'love_focus_gained',
		S => 'main2',
		F => 'love.focus',
		D => 'This is called in love.focus(f), if f is true.',
		VA => '1.4.3'
	),
	array(
		N => 'love_focus_lost',
		S => 'main2',
		F => 'love.focus',
		D => 'This is called in love.focus(f), if f is false.',
		VA => '1.4.3'
	),
	array(
		N => 'love_focus',
		S => 'main2',
		F => 'love.focus',
		D => 'This is called in love.focus(f), regardless of the value of f, in case this suits you better. If f is true then focus is gained, false if lost.',
		A => 'f',
		VA => '1.4.3'
	),
);

foreach ($hooks as $hook)
{
	echo '
<tr>
	<td>' . $hook['n'] . '</td>
	<td>' . $hook['s'] . '.lua</td>
	<td>' . ($hook['f'] ?? '&mdash;') . '</td>
	<td>' . $hook['d'] . '</td>
	<td>' . ($hook['a'] ?? '&mdash;') . '</td>
	<td>' . $hook['va'] . '</td>
</tr>';
}
?>

</table>
<p>To use a hook, place a file with the name of the hook and the .lua extension in the hooks folder in your plugin. So to use the hook called love_draw_end, you need a file love_draw_end.lua inside YourPlugin/hooks/.</p>
<p>To use the args in your hook, you can use <?php hyperlight('...', 'generic', 'tt'); ?>. So in love_update_start, which has the variable <tt>dt</tt>, you'd put <?php hyperlight('local dt = ...', 'generic', 'tt'); ?> at the top of your hook. In love_mousepressed_start, which has three arguments, you can use <?php hyperlight('local x, y, button = ...', 'generic', 'tt'); ?>.</p>
<p>If you need a hook that doesn't exist yet or have an idea for one, or if you need further help with developing a plugin, don't hesitate to tell Dav!</p>

<h2><a name="sourceedits">Source edits</a></h2>
<p>As of Ved beta 2, plugins can do find and replace operations on files in the Ved source code. Every internal Lua file can be modified this way, except for <tt>main.lua</tt>, <tt>corefunc.lua</tt>, <tt>plugins.lua</tt>, <tt>errorhandler.lua</tt>, <tt>incompatmain8.lua</tt>, <tt>incompatmain9.lua</tt>, <tt>love10compat.lua</tt> and <tt>love11compat.lua</tt>.</p>
<p>The file <tt>sourceedits.lua</tt> in your plugins folder controls these source edits. It contains an array in the following format:
<?php hyperlight('sourceedits =
{
	["SOURCENAME"] =
	{  -- First file to edit: SOURCENAME.lua
		{  -- Edit 1 in that file
			find = [[
FIND CODE
]],
			replace = [[
REPLACE BY THIS
]],
			ignore_error = false,
			luapattern = false,
			allowmultiple = false, -- allowmultiple nyi
		},
		{  -- Edit 2 in that file
			...
		},
	},
	["SOURCE2"] =
	{  -- Second file to edit: SOURCE2.lua
		...
	},
}', 'generic'); ?>
<tt>ignore_error</tt>, <tt>luapattern</tt> and <tt>allowmultiple</tt> are all optional and false by default.</p>
<p>If <tt>ignore_error</tt> is false (or missing), and the edit can't be made because the <tt>find</tt> code can't be found in the source file, then an orange warning screen will be shown to the user (which they can then dismiss and continue loading). If <tt>ignore_error</tt> is true, then this warning screen will not be shown.</p>
<p>If <tt>luapattern</tt> is true, then <tt>find</tt> will be interpreted as being in pattern format (aka Lua's regex, click <a href="http://lua-users.org/wiki/PatternsTutorial" target="_blank">here</a> and <a href="https://www.lua.org/manual/5.2/manual.html#6.4.1" target="_blank">here</a> for more information), if false or missing it will just be searched as a plain snippet of code.</p>
<p><tt>allowmultiple</tt> is currently not yet implemented, but if false it would warn if the same edit is being made multiple times in the same file.</p>
<p>If you need to include <tt>]]</tt> in your find and/or replacement string, it's possible to include it by replacing it with something like <tt>]] .. "]]" .. [[</tt></p>
<p>Example:
<?php hyperlight('sourceedits =
{
	["func"] =
	{
		{
			find = [[
function setColorArr(yourarray)
	love.graphics.setColor(yourarray[1], yourarray[2], yourarray[3])
end]],
			replace = [[
function setColorArr(yourarray)
	love.graphics.setColor(yourarray[3], yourarray[2], yourarray[1])
end]],
			ignore_error = false,
			luapattern = false,
			allowmultiple = false,
		},
	},
}', 'generic'); ?>
This changes the setColorArr function in func.lua so red and blue color values are swapped around for syntax highlighting in the script editor. This is also included in the updated example plugin.
</p>
<p>
It does not matter whether your plugin files use Unix-style (LF) line endings, Windows-style (CR+LF) ones, or even classic Mac (CR) ones. Make sure your Ved source files use LF ones, however! If you downloaded a packaged version (.love or Windows/Mac version), it'll probably be fine.
</p>

<h2><a name="including">Including files</a></h2>
<p>It's also possible to include entire source files in your plugin, which will be considered as being inside Ved's root directory. Included source files go in the <strong>include</strong> folder in your plugin. After that, it can just be included with <?php hyperlight('ved_require("your_file")', 'generic', 'tt'); ?>, in a hook or otherwise. Note that this is not much different from how you would normally include a file in Lua: <?php hyperlight('require("your_file")', 'generic', 'tt'); ?>.</p>
<p><span style="color:red;">Warning:</span> this is only intended for your own (original) plugin files, not edited versions of Ved source files (even though it will work)! Adding an entire file will stop official Ved updates from affecting these files (yes, after downloading a new version of Ved) and also overrides any other plugin editing them.</p>
<p>In Ved 1.1.4 and later, you can also have subfolders inside the <strong>include</strong> folder, so it's probably a good idea to put all your included files in a folder with the name of your plugin to avoid clashes with other plugins or future files in Ved, and then just include them with something like <?php hyperlight('ved_require("my_1st_plug/drawingcode")', 'generic', 'tt'); ?>.</p>
<p>Including assets like images is not yet supported in this way, this may be added later!</p>

<h2><a name="technicaldocumentation">Technical documentation</a></h2>
<p>There's a technical documentation of Ved that can be found <a href="internals.php" target="_blank">here</a>.</p>
<?php include('links.php'); ?>
</body>
</html>
