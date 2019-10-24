<?php
require('hyperlight.php');
?><!DOCTYPE html>
<html>
<head>
<title>Ved technical documentation</title>
<style>
td, th {
	padding: 4px;
}

.blu {
	color: blue;
}

tr.cellborders > td {
	border: 1px solid black;
}

h2 {
	border-bottom: 1px solid #333;
}

/*
h2 > a::after {
	content: "<a href=\"#" attr(name) "\">#</a>";
}
*/
</style>
<link rel="stylesheet" type="text/css" href="colors/customizedstyle.css?020217" id="theme">
</head>
<body>
<h1>Ved technical documentation</h1>
<p>This page is intended to document Ved's internals as well as possible. The page is still being worked on, and more things are being added over time. If you'd like to know more about anything specific in Ved that I haven't explained yet here, or not well enough (except for the easter eggs :P), feel free to ask! If you'd like more information on how to make plugins, check <a href="plugins.php" target="_blank">this page</a>. The repository is <a href="https://gitgud.io/Dav999/ved" target="_blank">here</a>.</p>
<p>Last updated: <strong><?php echo date('l j F Y H:i (T)', filemtime('ved_docs/internals.php')); /* previously getlastmod() */ ?></strong> (this is the last edit date of the file)</p>

<h2><a name="files">Files</a></h2>
<p>First of all, the following source files are used in Ved:</p>
<table border="1">
<tr><th>Filename</th><th>Description</th></tr>
<tr><td><tt>clargs.lua</tt></td><td>Stores and formats the command line help output when requested.<br>This file was added in Ved 1.1.0.</td></tr>
<tr><td><tt>conf.lua</tt></td><td>L&Ouml;VE's configuration file, controlling default window settings and loaded L&Ouml;VE modules.</td></tr>
<tr><td><tt>const.lua</tt></td><td>Constants - Contains tile numbers for all tilesets, known scripting commands, music names, and other lookup tables.</td></tr>
<tr><td><tt>coordsdialog.lua</tt></td><td>Contains code related to the little room coordinates input after hitting Q in the main editor. Before 1.4.0, this was part of <tt>dialog.lua</tt>.</td></tr>
<tr><td><tt>corefunc.lua</tt></td><td>Contains a few functions that are used so early in loading (and/or are used on the crash screen), they must exist before things like plugins and the error handler are loaded.</td></tr>
<tr><td><tt>devstrings.lua</tt></td><td>Used for defining new text strings during development of a new version, before putting them in all the language files.</td></tr>
<tr><td><tt>dialog.lua</tt></td><td>Contains code related to dialog boxes. Before 1.4.0, this also contained code for right click menus, scrollbars and VVVVVV-style text boxes, which have each been moved to their own separate files as of 1.4.0.</td></tr>
<tr><td><tt>dialog_uses.lua</tt></td><td>Contains callback functions and definitions of fields for dialogs, which are used as arguments for <tt>dialog.create(...)</tt></td></tr>
<tr><td><tt>drawhelp.lua</tt></td><td>Holds <tt>drawhelp()</tt>, called by <tt>love.draw()</tt> in state 15 (the help state). The help system is also used for level notes and the plugins list.</td></tr>
<tr><td><tt>drawlevelslist.lua</tt></td><td>Holds <tt>drawlevelslist()</tt>, called by <tt>love.draw()</tt> in state 6 (the loading screen state).</td></tr>
<tr><td><tt>drawmaineditor.lua</tt></td><td>Holds <tt>drawmaineditor()</tt>, called by <tt>love.draw()</tt> in state 1 (the main editor state).</td></tr>
<tr><td><tt>drawmap.lua</tt></td><td>Holds <tt>drawmap()</tt>, called by <tt>love.draw()</tt> in state 12 (the map state).</td></tr>
<tr><td><tt>drawscripteditor.lua</tt></td><td>Holds <tt>drawscripteditor()</tt>, called by <tt>love.draw()</tt> in state 3 (the script editor state).</td></tr>
<tr><td><tt>drawsearch.lua</tt></td><td>Holds <tt>drawsearch()</tt>, called by <tt>love.draw()</tt> in state 11 (the search state).</td></tr>
<tr><td><tt>errorhandler.lua</tt></td><td>Contains code for both the crash screen and the plugin error screen.</td></tr>
<tr><td><tt>filefunc_linmac.lua</tt></td><td>Since Ved 1.5.0, this contains functions necessary for accessing the VVVVVV levels and graphics folders on Linux and macOS. This uses the <tt>vedlib_filefunc_*</tt> library found in the <tt>libs</tt> folder via LuaJIT FFI. Also see <tt>love.load()</tt> in <tt>main2.lua</tt>: On Linux this library is compiled locally, if unsuccessful (due to missing <tt>gcc</tt>) we'll fallback to <tt>filefunc_lin_fallback.lua</tt> instead. On Mac, an already compiled version of the library is used.<br>Before Ved 1.5.0, this was split in <tt>filefunc_lin.lua</tt> and <tt>filefunc_mac.lua</tt> and used terminal utilities to list level files. <!-- Also has a function for opening a URL with <tt>xdg-open</tt> in case L&Ouml;VE 0.9.0 is being used (where <tt>love.system.openURL(url)</tt> doesn't exist yet)--></td></tr>
<tr><td><tt>filefunc_lin_fallback.lua</tt></td><td>Contains functions necessary for accessing the VVVVVV levels and graphics folders on Linux, if compiling the filefunc library was not successful (due to missing <tt>gcc</tt>). This uses command line utilities like <tt>ls</tt> to list level files and some other file-related things. <!-- Also has a function for opening a URL with <tt>xdg-open</tt> in case L&Ouml;VE 0.9.0 is being used (where <tt>love.system.openURL(url)</tt> doesn't exist yet)--></td></tr>
<tr><td><tt>filefunc_luv.lua</tt></td><td>Contains fallback <tt>love.filesystem</tt> functions for accessing fallback levels and graphics folders if the operating system is something other than Windows, macOS or Linux.</td></tr>
<!--<tr><td><tt>filefunc_mac.lua</tt></td><td>Contains functions necessary for accessing the VVVVVV levels and graphics folders on Mac OS X.<!- - Also has a function for opening a URL with <tt>open</tt> in case L&Ouml;VE 0.9.0 is being used (where <tt>love.system.openURL(url)</tt> doesn't exist yet)- -></td></tr>-->
<tr><td><tt>filefunc_win.lua</tt></td><td>Contains functions necessary for accessing the VVVVVV levels and graphics folders on Windows. As of Ved 1.5.0, this uses the Windows API for everything (including reading and writing level files, due to <tt>io.open</tt> being non-Unicode on Windows), before 1.5.0, it used command line utilities like <tt>dir</tt>.<!-- Also has a function for opening a URL with <tt>start</tt> in case L&Ouml;VE 0.9.0 is being used (where <tt>love.system.openURL(url)</tt> doesn't exist yet)--></td></tr>
<tr><td><tt>func.lua</tt></td><td>Contains many functions, especially general-purpose ones and core Ved functions.</td></tr>
<tr><td><tt>helpfunc.lua</tt></td><td>Contains certain functions related to (editing) level notes, and the rest of the help system.</td></tr>
<tr><td><tt>imagefont.lua</tt></td><td>Loads and readies <tt>font.png</tt> for use inside Ved.<br>This file was added in Ved 1.4.0.</td></tr>
<tr><td><tt>incompatmain8.lua</tt></td><td>If L&Ouml;VE 0.8 or lower is used, this is loaded from <tt>main.lua</tt>. It displays a message that outdated L&Ouml;VE is being used in all available languages.<br>Before Ved 1.4.5, this file was called <tt>incompatmain.lua</tt>.</td></tr>
<tr><td><tt>incompatmain9.lua</tt></td><td>If L&Ouml;VE 0.9.0 is used, this is loaded from <tt>main.lua</tt>. It displays a message that L&Ouml;VE 0.9.0 is no longer supported in all available languages.<br>This file was added in Ved 1.4.5.</td></tr>
<tr><td><tt>keyfunc.lua</tt></td><td>Handles the shortcut that can be used in the help screen to make text editable.</td></tr>
<tr><td><tt>loadallmetadata.lua</tt></td><td>Returns level metadata for the levels list from a different thread.</td></tr>
<tr><td><tt>loadconfig.lua</tt></td><td>Handles anything related to the settings.</td></tr>
<tr><td><tt>love10compat.lua</tt></td><td>Loaded only when L&Ouml;VE 0.10.0 or higher is used, and provides compatibility with those versions. Contains the new <tt>love.wheelmoved</tt> callback.</td></tr>
<tr><td><tt>love11compat.lua</tt></td><td>Loaded only when L&Ouml;VE 11.0 or higher is used, and provides compatibility with those versions. For example, this hijacks color functions so they work with 0-255 instead of 0-1.</td></tr>
<tr><td><tt>main.lua</tt></td><td>The first file that is loaded. Loads the fonts, sets a few basic variables, and loads <tt>plugins.lua</tt>, <tt>errorhandler.lua</tt> and, most importantly, <tt>main2.lua</tt>.</td></tr>
<tr><td><tt>main2.lua</tt></td><td>Loads most other source files and assets, and contains pretty much all <tt>love.*</tt> callbacks.</td></tr>
<tr><td><tt>mapfunc.lua</tt></td><td>Contains functions related to rendering and updating the map overview screen.<br>This file was added in Ved 1.4.2.</td></tr>
<tr><td><tt>music.lua</tt></td><td>Handles reading and writing <tt>vvvvvvmusic.vvv</tt>, <tt>mmmmmm.vvv</tt>, and other custom music files.<br>This file was added in Ved 1.6.0.</td></tr>
<tr><td><tt>plugins.lua</tt></td><td>Makes sure plugins and their file edits and hooks are loaded</td></tr>
<tr><td><tt>resizablebox.lua</tt></td><td>Has a system for a box that can be resized by dragging borders with the mouse. Was formerly used for resizing script boxes, but it was glitchy so it's now unused.</td></tr>
<tr><td><tt>rightclickmenu.lua</tt></td><td>Contains code related to right click menus. Before 1.4.0, this was part of <tt>dialog.lua</tt>.</td></tr>
<tr><td><tt>roomfunc.lua</tt></td><td>Contains functions related to rooms in levels, tiles and such.</td></tr>
<tr><td><tt>scaling.lua</tt></td><td>Hijacks/Decorates a couple of L&Ouml;VE functions to make scaling work perfectly</td></tr>
<tr><td><tt>scriptfunc.lua</tt></td><td>Contains functions related to scripts.</td></tr>
<tr><td><tt>scrollbar.lua</tt></td><td>Contains code related to scrollbars. Before 1.4.0, this was part of <tt>dialog.lua</tt>.</td></tr>
<tr><td><tt>searchfunc.lua</tt></td><td>Contains functions related to searching levels.</td></tr>
<tr><td><tt>slider.lua</tt></td><td>Used for the number control in the options screen, holds the function <tt>int_control</tt></td></tr>
<tr><td><tt>updatecheck.lua</tt></td><td>Checks what the latest version of Ved is via HTTP, and reports back. This is run inside a separate thread.</td></tr>
<tr><td><tt>vvvvvv_textbox.lua</tt></td><td>Contains code related to VVVVVV-style text boxes. Before 1.4.0, this was part of <tt>dialog.lua</tt>.</td></tr>
<tr><td><tt>vvvvvvxml.lua</tt></td><td>Loads and parses levels from .vvvvvv level files, and creates and saves them. Also has a function for &quot;loading&quot; a blank level.</td></tr>
</table>

<h2><a name="states">States</a></h2>
<p>Ved uses state numbers to represent different screens, menus and interfaces. <!--(note about state and oldstate and functions)--> Blue state numbers are not normally used anymore, and/or are not normally accessible, and many of them are leftover testing states.</p>
<table border="1">
<tr><th>#</th><th>Description</th></tr>
<tr><td class="blu">-3</td><td>Black screen</td></tr>
<tr><td>-2</td><td>tostate 6</td></tr>
<tr><td>-1</td><td>Display error (expected: errormsg)</td></tr>
<tr><td class="blu">0</td><td>Temp main menu (enter state). Can be accessed in debug mode by pressing F12.</td></tr>
<tr><td>1</td><td>The editor (will expect things to have been loaded)</td></tr>
<tr><td class="blu">2</td><td>Syntax highlighting test</td></tr>
<tr><td>3</td><td>Scripting editor</td></tr>
<tr><td class="blu">4</td><td>Some XML testing</td></tr>
<tr><td class="blu">5</td><td>Filesystem testing</td></tr>
<tr><td>6</td><td>Listing of all files in the levels folder, and load a level from here (loading screen)</td></tr>
<tr><td class="blu">7</td><td>Display all sprites from sprites.png where you can get the number of the sprite you're hovering over</td></tr>
<tr><td class="blu">8</td><td>Ancient save screen (you can type in a name and press enter)</td></tr>
<tr><td class="blu">9</td><td>Dialog test, and right click menu test</td></tr>
<tr><td>10</td><td>List of scripts, and enter one to load</td></tr>
<tr><td>11</td><td>Search</td></tr>
<tr><td>12</td><td>Map</td></tr>
<tr><td>13</td><td>Options screen</td></tr>
<tr><td class="blu">14</td><td>Enemy picker preview</td></tr>
<tr><td>15</td><td>Help/Level notes/Plugins list</td></tr>
<tr><td class="blu">16</td><td>Scroll bar test</td></tr>
<tr><td class="blu">17</td><td>folderopendialog utility</td></tr>
<tr><td class="blu">18</td><td>Show undo/redo stacks</td></tr>
<tr><td>19</td><td>Flags list</td></tr>
<tr><td class="blu">20</td><td>Resizable box test</td></tr>
<tr><td class="blu">21</td><td>Display overlapping entities (may be a visible function later) (maybe doesn't work properly)</td></tr>
<tr><td class="blu">22</td><td>Load a script file in the 3DS format (lines separated by dollars)</td></tr>
<tr><td class="blu">23</td><td>Load a script file NOT in the 3DS format (lines separated by \r\n or \n)</td></tr>
<tr><td class="blu">24</td><td>Simple plugins list (already not used)</td></tr>
<tr><td>25</td><td>Syntax highlighting color settings</td></tr>
<tr><td class="blu">26</td><td>Font test</td></tr>
<tr><td>27</td><td>Display/Scale settings</td></tr>
<tr><td>28</td><td>Level stats</td></tr>
<tr><td class="blu">29</td><td>Plural forms test</td></tr>
<tr><td>30</td><td>Assets viewer main menu</td></tr>
<tr><td>31</td><td>Music player/editor, sound player</td></tr>
<tr><td>32</td><td>Graphics viewer</td></tr>
<tr><td colspan="2">100 and further can be allocated by plugins (next paragraph)</td></tr>
</table>

<h2><a name="stateallocation">State allocation</a></h2>
<p>In Ved 1.1.4 and higher, plugins can allocate an amount of states for their own use, without using hardcoded state numbers, making it unnecessary to think of unique state numbers that won't interfere with any other plugins or future Ved updates. The following functions can be used:</p>
<dl>
<dt><?php hyperlight('allocate_states(name [, amount=1])', 'generic', 'tt'); ?></dt>
<dd>This function is used to allocate the given <tt>amount</tt> of states with identifier <tt>name</tt>.</dd>
<dt><?php hyperlight('in_astate(name [, s=0])', 'generic', 'tt'); ?></dt>
<dd>This function returns true if the current state is <tt>s</tt> for identifier <tt>name</tt>. These state numbers start at 0.</dd>
<dt><?php hyperlight('to_astate(name [, new=0 [, dontinitialize=false]])', 'generic', 'tt'); ?></dt>
<dd>Change state to state number <tt>new</tt> for identifier <tt>name</tt>, and if <tt>dontinitialize</tt> is set, call hook <tt>func_loadstate</tt>.</dd>
</dl>
<p>For example, take a plugin called My First Plugin, which uses three states. Upon startup, like in hook <tt>love_load_start</tt> or <tt>love_load_end</tt>, the plugin calls <?php hyperlight('allocate_states("my_1st_plug", 3)', 'generic', 'tt'); ?>. If this is the only plugin, or the first plugin to call <tt>allocate_states()</tt>, the allocated states will now, internally, be 100, 101 and 102. Let's say My First Plugin has three buttons to go to each of the allocated states. The first button, when clicked, would call <?php hyperlight('to_astate("my_1st_plug", 0)', 'generic', 'tt'); ?>, the second would call <?php hyperlight('to_astate("my_1st_plug", 1)', 'generic', 'tt'); ?> and the third would call <?php hyperlight('to_astate("my_1st_plug", 2)', 'generic', 'tt'); ?>. Hook <tt>love_draw_state</tt>, would contain something like this:</p>
<?php hyperlight('if in_astate("my_1st_plug", 0) then
	-- Insert drawing code for first state!
	statecaught = true
elseif in_astate("my_1st_plug", 1) then
	-- Insert drawing code for second state!
	statecaught = true
elseif in_astate("my_1st_plug", 2) then
	-- Insert drawing code for third state!
	statecaught = true
end', 'generic'); ?>
<p>The hook <tt>func_loadstate</tt> could contain something similar for initialization code for all the states (but without <?php hyperlight('statecaught = true', 'generic', 'tt'); ?>)</p>
<p>The identifying name can be anything, but this name should be unique to one plugin. It's also possible to allocate multiple blocks of state numbers within the same plugin, if you use different names. If your plugin only has one state, you can leave out the number (<?php hyperlight('allocate_states("my_1st_plug")', 'generic', 'tt'); ?>, <?php hyperlight('in_astate("my_1st_plug")', 'generic', 'tt'); ?>, <?php hyperlight('to_astate("my_1st_plug")', 'generic', 'tt'); ?>). And of course, this means you can have multiple states that are only referred to by string names (I can see how <?php hyperlight('in_astate("my_1st_plug_menu")', 'generic', 'tt'); ?> and <?php hyperlight('in_astate("my_1st_plug_display")', 'generic', 'tt'); ?> can be more pleasing than <?php hyperlight('in_astate("my_1st_plug", 0)', 'generic', 'tt'); ?> and <?php hyperlight('in_astate("my_1st_plug", 1)', 'generic', 'tt'); ?>). It's up to you to choose whatever you like most, or whatever works best for your plugin.</p> 

<h2><a name="loveversioncompat">L&Ouml;VE version compatibility</a></h2>
<p>Ved is compatible with all revisions of L&Ouml;VE 0.9.x, 0.10.x and 11.x (except L&Ouml;VE 0.9.0 as of Ved 1.4.2), but its code is written for 0.9.x. Compatibility with newer versions is mostly achieved by causing update changes to be undone; for example, L&Ouml;VE functions that were renamed or expect different arguments are redefined/hijacked and then called by those redefinitions if arguments or return values need to be passed differently, and callbacks that get "new-style" data from L&Ouml;VE get a bit of conversion code at the top. There are a few instances of conditionals depending on the version number in regular code, but that is not very common.</p>

<h3>Features unsupported in older L&Ouml;VE versions</h3>
<p>Nevertheless, there are simply some features or improved behavior added in later L&Ouml;VE versions, which Ved takes advantage of, that simply can't be backported to previous L&Ouml;VE versions. None of these are particularly important features for Ved's main purpose of editing levels, but it is still good to document them.</p>

<p><strong>Being able to use <tt>font.png</tt> from the VVVVVV graphics folder as the main font</strong><br>
<em>This feature is only supported in L&Ouml;VE versions <strong>0.10.0 and up</strong>.</em></p>

<p>This is because in L&Ouml;VE versions previous to 0.10.0, the font returned by <a href="https://love2d.org/wiki/love.graphics.newImageFont"><tt>love.graphics.newImageFont()</tt></a> automatically had 1 pixel of extra horizontal spacing, and there was no way to change this. If you used a custom <tt>font.png</tt> with 1 pixel of extra spacing for each glyph, it would look really ugly, partly because you wouldn't be used to it being rendered that way, but mostly because Ved prints text assuming there's no 1 pixel of extra space for each glyph.</p>
<p>This problem is fixed in L&Ouml;VE 0.10.0+ because it added an optional third argument to <tt>love.graphics.newImageFont()</tt> to specify the spacing, which also lets you use negative values.</p>
<p>On a side note, <tt>tinynumbers</tt>, Ved's F9 hotkey font, doesn't have this problem. This is because of a semi-hacky workaround: the font image is intentionally made with 1 less pixel of space per glyph, and then when it gets passed to <tt>love.graphics.newImageFont()</tt>, it gets 1 pixel of extra spacing either because it's below L&Ouml;VE 0.10.0 and it's forced or because we've specified 1 pixel of spacing in L&Ouml;VE 0.10.0+.</p>

<p><strong>Having the F9 hotkey font change depending on operating system, language, etc.</strong><br>
<em>This feature is only supported in L&Ouml;VE versions <strong>0.10.0 and up</strong></em>.</p>

<p>This is referring to the feature where the characters on the hotkeys that show up when you hold down F9 will change to match your operating system and language. This means that, for example, Ctrl will change to Cmd on macOS, and Ctrl will change to Strg if your language is German. (If you're a German macOS user then it will still be Cmd.)</p>
<p>This feature depends on <a href="https://love2d.org/wiki/Font:setFallbacks"><tt>Font:setFallbacks()</tt></a>, which was only added in L&Ouml;VE 0.10.0. Not much we can do without it.</p>

<p><strong>Basically anything to do with jumping around the track of the currently playing audio in the music and sound effect viewers</strong><br>
<em>This feature is only supported in L&Ouml;VE versions <strong>0.10.0 and up</strong></em>.</p>

<p>In L&Ouml;VE versions before 0.10.0, you can't jump around the track of the currently playing music or sound effect. That means you cannot click on the track to go to a certain position, nor can you use (Shift)+(kp)Left/Right to move 5 or 10 seconds forwards or backwards.</p>
<p>The reason is simple: we need to know the duration of the currently playing audio. The only function that does this is <a href="https://love2d.org/wiki/Source:getDuration"><tt>Source:getDuration()</tt></a>, and it only exists starting in L&Ouml;VE 0.10.0.</p>
<p>Without knowing the duration of the audio, clicking on the track becomes meaningless, because one end is supposed to be the start of the audio (time t=0) and the other end is supposed to be the end of the audio (time t&#61;&lt;<!-- probably shouldn't use '=' next to '&lt;' here directly, because PHP -->duration of audio&gt;). Without the duration, we don't know what timecode the other end should be. So if one song is, let's say, 2:30 long and the other is 5:00 long, then in the 5:00-long song the middle of the track is 2:30, and in the 2:30-long song the middle of the track is 1:15 - but without knowing the duration of each we don't know where each timecode is supposed to be placed on the track for each song.</p>
<p>Another consequence of not knowing the duration is that we can't make sure that you don't go past the end of the track when you use (Shift)+(kp)Left/Right to jump around. The end of the track is determined by its duration, which we don't know. So we wouldn't know if you went past the end or not without knowing the duration of the audio.</p>

<h2><a name="debugmode">Debug mode</a></h2>
<p>Debug mode is a special mode used to access certain features and information that can be useful for debugging and developing Ved. Enabling debug mode has the following effects:</p>
<ul>
	<li>You can jump to any state by pressing F12</li>
	<li>The window title bar displays the FPS, state number, window size, cursor position and L&Ouml;VE version number.</li>
	<li>Entities have tooltips with their properties</li>
	<li>You can access the lua_debug console by pressing Ctrl+PageUp. Make sure you do have a console attached, this blocks the entire Ved window until you type <tt>cont</tt> in the console. This shortcut is always available on a crash screen, by the way, even outside debug mode.</li>
	<li>You can limit the framerate to 60, 30 or 15 by pressing Ctrl+PageDown</li>
	<li>Entity IDs/table keys are shown in the raw entity properties dialog</li>
	<li>The hidden tileset creator can be accessed by pressing LCtrl+\ in the main editor (I'm pretty sure I've written an explanation of it somewhere, but I may document it here as well</li>
	<li>Pressing LCtrl+' in the main editor will print all tileset and tilecol numbers to the console</li>
	<li>Pressing F11 will print all global variables to the console</li>
	<li>Holding / in the main editor would display <img src="entity.png"> instead of all entities, but that key now jumps to the script editor.</li>
	<li>A visual indicator is added that displays when text input is being taken.</li>
	<li>On the loading screen, you can add a fake level to the list of levels by pressing Shift+F2, and (visually) remove the last level from the list by pressing Shift+F3. This is for testing the scrolling area and such.</li>
</ul>
<p>Debug mode is enabled by the boolean variable <tt>allowdebug</tt>. It is possible to enable it in-app by going from the load screen to the Ved options, clicking and holding the OK button, and "dragging" over the Send Feedback button holding the right mouse button as well.</p>

<h2><a name="editorvars">Editor-related variables</a></h2>
<h3>Current room</h3>
The coordinates for the current room are stored in <tt>roomx</tt> and <tt>roomy</tt>, these start at 0 like in internal scripting.

<h3>Selected tool</h3>
The number for the currently selected tool is stored in <tt>selectedtool</tt> (which starts at 1). The selected subtools are stored for each separate tool, and are stored in the table <tt>selectedsubtool</tt>, which has 17 elements.

<h3>Selected tileset</h3>
Even though tileset information is also stored in the room metadata, the currently selected tileset and tile color has always stored in the variables <tt>selectedtileset</tt> and <tt>selectedcolor</tt>.

<h3>Undo/redo stacks</h3>
The variable that keeps track of actions that can be undone is <tt>undobuffer</tt>, and the one that keeps track of the actions that have been undone (and can be redone) is <tt>redobuffer</tt>. These are tables. If an undoable action is taken, an entry is added to the end of <tt>undobuffer</tt>, and <tt>redobuffer</tt> is cleared. When undoing, the function <tt>undo()</tt> is called, which undoes the latest action appropriately, and moves the last entry in <tt>undobuffer</tt> to the end of <tt>redobuffer</tt>. When redoing, the function <tt>redo()</tt> is called, which redoes the latest action appropriately, and moves the last entry in <tt>redobuffer</tt> to the end of <tt>undobuffer</tt>. Entries in <tt>undobuffer</tt> and <tt>redobuffer</tt> are tables with different properties depending on the <tt>undotype</tt> it has.

<h3>Other things</h3>
<p>The number of the currently selected tile is stored in <tt>selectedtile</tt>.</p>
<p>To edit roomtext and (re)name scripts in script boxes and terminals, Ved uses <tt>editingroomtext</tt>. The entity ID of the entity <tt>data</tt> attribute currently being edited is stored in <tt>editingroomtext</tt>. You can get the entity being edited by simply doing <tt>entitydata[editingroomtext]</tt>. Since tables in Lua are 1-indexed, <tt>editingroomtext</tt> cannot be 0, so to check if we are currently editing the roomtext, just do <tt>editingroomtext &gt; 0</tt>; to check if we are not, just do <tt>editingroomtext == 0</tt>.</p>
<p><tt>editingroomname</tt> is a boolean that is true when the current room's roomname is being edited, and false when it isn't. However, you should use <tt>toggleeditroomname()</tt> to start and stop editing the roomname.</p>
<p>When editing enemy and platform boundaries, Ved uses <tt>editingbounds</tt>. It is 0 when no boundaries are being edited. Its magnitude (i.e. its absolute value, i.e. ignore the negative sign if there is one) will be 1 for platform bounds, and 2 for enemy bounds. Its sign (i.e. whether it's positive or negative) will be negative when placing the first corner (the top-left corner), and will be positive when placing the second corner (the bottom-right corner). So to reiterate: when editing platform bounds, <tt>editingbounds</tt> will go from 0, to -1, to 1; and when editing enemy bounds, <tt>editingbounds</tt> will go from 0, to -2, to 2.<br>You can start a boundary edit by calling either <tt>changeplatformbounds()</tt> or <tt>changeenemybounds()</tt>.</p>
<p>The variable that controls the eraser (i.e. whether right-clicking will erase tiles if holding a tile brush) is <tt>eraserlocked</tt>. When it is true (by default), you can erase tiles using right-click. When false, you cannot.</p>
<p>Whether or not enemy and platform bounds are rendered is controlled by <tt>showepbounds</tt>.</p>
<p>The tiles picker (e.g. what pops up when you click on "Show all", or press/hold Ctrl+Shift) being open or not is controlled by <tt>tilespicker</tt>. <tt>tilespicker_shortcut</tt> controls whether or not you are holding the shortcut, so Ved knows to close it when you release Ctrl+Shift. But using RCtrl+RShift will keep the tiles picker open (and mixing Left/Right Ctrl+Shift will be the same as LCtrl+LShift - that is, it won't "stick" and you have to keep holding the key combo).</p>
<!-- TODO: expand this with editingroomtext/name, editingbounds and maybe other things -->

<h2><a name="levelvarsfuncs">Level-related variables and functions</a></h2>
<h3>Level metadata</h3>
The variable <tt>metadata</tt> is a table with the different options as key-value pairs. The map width, map height and level music are not part of the metadata in the VVVVVV level format, but internally in Ved, they are. So all of the metadata variables are as follows:
<?php hyperlight('metadata["Creator"]
metadata["Title"]
metadata["Created"]
metadata["Modified"]
metadata["Modifiers"]
metadata["Desc1"]
metadata["Desc2"]
metadata["Desc3"]
metadata["website"]
metadata["mapwidth"]
metadata["mapheight"]
metadata["levmusic"]', 'generic'); ?>

<h3>Room tiles</h3>
<tt>roomdata</tt> is a big table of tables that stores all the tiles in a level. <?php hyperlight('roomdata[roomy][roomx]', 'generic', 'tt'); ?> is a 1D array with all the tiles for the current room (the variables <tt>roomx</tt> and <tt>roomy</tt> are the current room's coordinates, and they start at 0). The tiles in the room are numbered starting at 1, so the 3rd tile from the left and top is <?php hyperlight('roomdata[roomy][roomx][(2*40)+(2+1)]', 'generic', 'tt'); ?>.

<h3>Entities</h3>
<tt>entitydata</tt> contains all the entities in a level. Each element of <tt>entitydata</tt> is structured as follows:
<?php hyperlight('{
	x = 12,
	y = 34,
	t = 17,
	p1 = 0,
	p2 = 0,
	p3 = 0,
	p4 = 0,
	p5 = 320,
	p6 = 240,
	data = "Roomtext or script name"
}', 'generic'); ?>

<h3>Room metadata</h3>
<tt>levelmetadata</tt> is the table containing room metadata, or, looking at the VVVVVV level format, each <tt>edLevelClass</tt> inside the <tt>levelMetaData</tt> tags. Indexes for this table start at 1 (because Lua, as you may know). So the metadata for the current room is <tt>levelmetadata[roomy*20 + roomx+1]</tt>, since <tt>roomx</tt> and <tt>roomy</tt> start at 0. Each element is structured as follows:
<?php hyperlight('{
	tileset = 0,
	tilecol = 0,
	platx1 = 0,
	platy1 = 0,
	platx2 = 320,
	platy2 = 240,
	platv = 4,
	enemyx1 = 0,
	enemyy1 = 0,
	enemyx2 = 320,
	enemyy2 = 240,
	enemytype = 0,
	directmode = 0,
	warpdir = 0,
	roomname = "Roomname",
	auto2mode = 0,
}', 'generic'); ?>
<tt>directmode</tt> is always present, even after a VVVVVV 2.0 level is loaded. If <tt>auto2mode == 1</tt> then multi-tileset mode is used for that room, and in that case <tt>directmode</tt> should be <tt>0</tt>. However, when saving, <tt>directmode</tt> is set to <tt>1</tt> in the level file because <tt>auto2mode</tt> is not saved to it.

<h3>Scripts</h3>
Two tables for this one: <tt>scriptnames</tt> which is a simple table of all the script names with numeric keys in the correct order, and <tt>scripts</tt> which contain the actual scripts, with script names as keys. Each element of <tt>scripts</tt> is a table itself, with all the lines in that script. An example population can be given as follows:
<?php hyperlight('scriptnames = {
	[1] = "mynewscript",
	[2] = "mynewscript_load"
}
scripts = {
	mynewscript_load = {
		[1] = "ifflag(2,stop)",
		[2] = "flag(2,on)",
		[3] = "iftrinkets(0,mynewscript)"
	},
	mynewscript = {
		[1] = "reply(3)",
		[2] = "I probably don\'t really need it,",
		[3] = "but it might be nice to take it",
		[4] = "back to the ship to study..."
	}
}', 'generic'); ?>
If you're wondering how Ved stores internal scripts: for both loadscript and say(-1) internal script modes, <?php hyperlight('text(1,0,0,3) #v', 'generic', 'tt'); ?> and <?php hyperlight('say(x) #v', 'generic', 'tt'); ?> are put in between each block if the script has to be split. The loadscript mode starts with <?php hyperlight('squeak(off) #v', 'generic', 'tt'); ?> and <?php hyperlight('say(x) #v', 'generic', 'tt'); ?>, and ends with <?php hyperlight('loadscript(stop) #v', 'generic', 'tt'); ?> and <?php hyperlight('text(1,0,0,3) #v', 'generic', 'tt'); ?>. The say(-1) mode starts with <?php hyperlight('squeak(off) #v', 'generic', 'tt'); ?>, <?php hyperlight('say(-1) #v', 'generic', 'tt'); ?>, <?php hyperlight('text(1,0,0,3) #v', 'generic', 'tt'); ?>, and <?php hyperlight('say(x) #v', 'generic', 'tt'); ?>, and ends with <?php hyperlight('loadscript(stop) #v', 'generic', 'tt'); ?> (with no extra <tt>text</tt> line like the loadscript internal script mode has). If you want to check, hold down the shift key while opening a script. The same goes for checking checking flag names - Ved converts them to numbers when leaving the script editor and converts them back into names when opening it, unless you hold shift while opening.
<!-- Also explain storage of internal scripts here, and when flag names are handled -->

<h3>Counts</h3>
The table <tt>count</tt> keeps count of the number of trinkets, crewmates and entities in the level, and keeps track of the integer key of the start point entity. It also counts the number of sanity checks that failed when loading the level. As can be seen in <tt>vvvvvvxml.lua</tt>:
<?php hyperlight('	local mycount = {trinkets = 0, crewmates = 0, entities = 0, startpoint = nil, FC = 0}  -- FC = Failed Checks
', 'generic'); ?>
(<tt>mycount</tt> is local to that function, and will be returned and then stored to <tt>count</tt>. <em>So this whole system of creating tables locally and then returning references to them works?</em> Yeah, it does, funny eh? I should probably rewrite that a little bit though.)

<h3>Metadata entity (level notes, flag names)</h3>
<p>The metadata entity is used by Ved to store data that is specific to a certain level. It is a roomtext entity at x=800 y=600, which means it's in room 21,21 (1-indexed). The data is formatted with several levels of separation characters:</p>
<table>
	<tr><td><strong>|</strong></td><td>primary separator (see this as separating different &quot;tables&quot; of data)</td></tr>
	<tr><td><strong>$</strong></td><td>secondary separator (see this as separating different &quot;rows&quot; or &quot;records&quot; inside a &quot;table&quot;)</td></tr>
	<tr><td><strong>@</strong></td><td>tertiary separator (see this as separating different &quot;columns&quot; or &quot;properties&quot; inside a &quot;rows&quot;/&quot;records&quot;)</td></tr>
</table>
<p>For example, one of the &quot;tables&quot; contains level notes. Each level note is separated by <strong>$</strong>, and inside a level note, the name and the contents of the note are separated by <strong>@</strong>.</p>
<p>Accent grave (<strong>`</strong>) is the escape character; if the real versions of certain characters need to be represented, they are escaped as follows:</p>
<table border="1" style="font-weight: bold; text-align:center;">
	<tr><td>`</td><td>`g</td></tr>
	<tr><td>|</td><td>`p</td></tr>
	<tr><td>$</td><td>`d</td></tr>
	<tr><td>@</td><td>`a</td></tr>
	<tr><td>(newline)</td><td>`n</td></tr>
	<tr><td>(2 spaces)</td><td>`_</td></tr>
</table>
<p>The function <?php hyperlight('despecialchars(text)', 'generic', 'tt'); ?> encodes the raw characters to escaped format, <?php hyperlight('undespecialchars(text)', 'generic', 'tt'); ?> decodes escaped characters back to raw characters.</p>
<p>As said, <strong>|</strong> is the primary separator, which separates the following items:</p>
<table border="1">
	<tr><th></th><th>Description</th><th>&ge;V</th></tr>
	<tr><td>1</td><td>Metadata entity version number</td><td>0?</td></tr>
	<tr><td>2</td><td>Flag names</td><td>2</td></tr>
	<tr><td>3</td><td>(Reserved)</td><td>-</td></tr>
	<tr><td>4</td><td>Level variables, for use by Ved or plugins (Why haven't I documented this out of <a href="https://gitgud.io/Dav999/ved/commit/af0aae6462453128e37e8e23c6798b2dc6a93365" target="_blank">commit</a> <a href="https://gitgud.io/Dav999/ved/commit/0b1fa3592f7995ee553d5246c71d5031f0a0dc1b" target="_blank">messages</a>)</td><td>3</td></tr>
	<tr><td>5</td><td>Level notes</td><td>0?</td></tr>
</table>
<p>(more coming soon)</p>

<h3>Clipboard room format</h3>
<p>Currently, when you copy a room to the clipboard, it's stored in a comma-separated format. It consists of 1215 values separated by commas, and it's structured as follows (indices start at 1, as in Lua):</p>
<table>
<tr style="text-align: center;"><?php for ($i = 1; $i <= 15; $i++) echo '<td>' . $i . '</td>'; ?><td>16 &mdash; 1215</td></tr>
<tr class="cellborders">
	<td>Tileset</td>
	<td>Tilecol</td>
	<td colspan="4">Platf. bounds x1,y1,x2,y2</td>
	<td>Platv</td>
	<td colspan="4">Enemy bounds x1,y1,x2,y2</td>
	<td>Enemy type</td>
	<td>Direct mode</td>
	<td>Warp dir</td>
	<td>Room name*</td>
	<td>1200 tile numbers</td>
</tr>
</table>
<p>In the room name, commas are replaced by the character <tt>&#x00b4;</tt> (U+00B4 ACUTE ACCENT).</p>
<p>In this format, entities are not copied. I'm planning to replace this CSV system by an XML format, which will also contain entities. Data in the old format will still be pasteable, and I'll probably also leave in a way to copy as CSV.</p>

<!--<h2><a name="generalvars">Important general variables</a></h2>-->


<h2><a name="dialogs">Dialogs</a></h2>
In Ved 1.4.0, the dialogs system was overhauled. To create a new dialog, you can call <tt>dialog.create</tt>:
<dl>
<dt><?php hyperlight('dialog.create(message, buttons, handler, title, fields, noclosechecker, identifier)', 'generic', 'tt'); ?></dt>
<dd>
	<tt>message</tt> is the body of the dialog box. <em>This is the only required argument.</em><br>
	<tt>buttons</tt> speaks for itself as to what it is (but see below), if not specified, only an OK button will be present.<br>
	<tt>handler</tt> is a function that will be called when the dialog is closed, and will be provided with the button that was pressed and the dialog fields.<br>
	<tt>title</tt> is the title text of the dialog. Setting this to an empty string is not needed anymore.<br>
	<tt>fields</tt> defines the input fields that the dialog has, see below. If not given, the dialog has no input fields.<br>
	<tt>noclosechecker</tt> is a function of which the main purpose is to check whether a button shouldn't actually close the dialog, and should return <tt>true</tt> if so - think of apply buttons<br>
	<tt>identifier</tt> is just an extra internal label indicating the type of dialog, rarely used (it's used for the quit dialog to know that a quit dialog is already on top)
</dd>
</dl>
<h3>Buttons</h3>
<p>Strictly speaking, the <tt>buttons</tt> parameter accepts a list/table of buttons. For each element, if that element is a string, that string will be displayed as-is. But if possible, it should be an integer, representing one of the built-in buttons. A list of buttons is available as <tt>DB</tt>, so for example, <tt>DB.YES</tt> is a &quot;Yes&quot; button. The list is as follows:</p>
<table border="1">
<tr><th>Constant</th><th>Value</th><th>Button label</th></tr>
<tr><td><tt>DB.OK</tt></td><td>1</td><td>OK</td></tr>
<tr><td><tt>DB.CANCEL</tt></td><td>2</td><td>Cancel</td></tr>
<tr><td><tt>DB.YES</tt></td><td>3</td><td>Yes</td></tr>
<tr><td><tt>DB.NO</tt></td><td>4</td><td>No</td></tr>
<tr><td><tt>DB.APPLY</tt></td><td>5</td><td>Apply</td></tr>
<tr><td><tt>DB.QUIT</tt></td><td>6</td><td>Quit</td></tr>
<tr><td><tt>DB.DISCARD</tt></td><td>7</td><td>Discard</td></tr>
<tr><td><tt>DB.SAVE</tt></td><td>8</td><td>Save</td></tr>
<tr><td><tt>DB.CLOSE</tt></td><td>9</td><td>Close</td></tr>
<tr><td><tt>DB.LOAD</tt></td><td>10</td><td>Load</td></tr>
</table>
<p><tt>DB.LOAD</tt> was added in Ved 1.6.0.</p>
<p>There's also built-in lists of buttons available as <tt>DBS</tt>, like <tt>DBS.YESNO</tt>, which stands for <tt>{DB.YES, DB.NO}</tt>, meaning a Yes and No button.</p>
<table border="1">
<tr><th>Constant</th><th>Buttons</th></tr>
<tr><td><tt>DBS.OK</tt></td><td>OK</td></tr>
<tr><td><tt>DBS.QUIT</tt></td><td>Quit</td></tr>
<tr><td><tt>DBS.YESNO</tt></td><td>Yes, No</td></tr>
<tr><td><tt>DBS.OKCANCEL</tt></td><td>OK, Cancel</td></tr>
<tr><td><tt>DBS.OKCANCELAPPLY</tt></td><td>OK, Cancel, Apply</td></tr>
<tr><td><tt>DBS.SAVEDISCARDCANCEL</tt></td><td>Save, Discard, Cancel</td></tr>
<tr><td><tt>DBS.YESNOCANCEL</tt></td><td>Yes, No, Cancel</td></tr>
<tr><td><tt>DBS.SAVECANCEL</tt></td><td>Save, Cancel</td></tr>
<tr><td><tt>DBS.LOADCANCEL</tt></td><td>Load, Cancel</td></tr>
</table>
<p><tt>DBS.SAVECANCEL</tt> and <tt>DBS.LOADCANCEL</tt> were added in Ved 1.6.0.</p>
<h3>Handler</h3>
<p>The purpose of the handler function is to take action after closing a dialog. For example, if a question is asked whether the user wants to destroy something, then that should be done if (and only if) the user chooses <tt>DB.YES</tt>.</p>
<p>The handler is a function that can take up to five arguments:
<ul>
	<li>The first is the <u>returned button</u> (an element of the <tt>buttons</tt> list provided to <tt>dialog.create</tt>).</li>
	<li>The second argument is a table with all the contents of the <u>input fields</u>, where input field keys are the keys, and their inputs are the values.</li>
	<li>Optionally, the &quot;identifier&quot; of the dialog, if given when creating the dialog</li>
	<li>A boolean that is <tt>true</tt> if closing the dialog has been prevented by the no-close checker (more below)</li>
	<li>As of Ved 1.4.5: the dialog object</li>
</ul>
The input fields are provided regardless of the button pressed - a Cancel button doesn't have any special meaning and the dialog handler should deal with it to ignore the input fields in that case (if that's what you want).</p>
<p>Dialog handlers as used in Ved's code can be found in the file <tt>dialog_uses.lua</tt>, starting with <tt>dialog.callback</tt>. An example handler is the following. Assume the buttons for this dialog are DBS.YESNOCANCEL. In this example, users press Yes if they want a new dialog to be created showing what they entered in a field with the key <tt>name</tt>, press No if they still want a dialog but don't want to know their input, and press Cancel if they want no new dialog.</p>
<?php hyperlight('function(button, fields)
	if button == DB.YES then
		dialog.create("You pressed Yes, and the input with key \\"name\\" is " .. fields.name)
	elseif button == DB.NO then
		dialog.create("You pressed No! Apparently you don\'t want to know what you entered, but you still want a dialog.")
	end
end', 'generic'); ?>
<tt>DB.CANCEL</tt> is not checked, therefore the handler does nothing if that button is pressed.

<h3>No-close checker</h3>
<p>No-close checkers are similar to handlers, but they are called before the dialog closes. This function can stop the dialog from being closed by returning <tt>true</tt>, and thus are useful for creating error messages if the user puts in invalid input. They can also be used to not close the dialog if an Apply button is pressed, for example.</p>
<p>The arguments for the no-close checker are the same as for the main handler, except the fourth argument (closing prevented by no-close checker) doesn't exist, which means the fourth argument is the dialog object. If the no-close checker returns <tt>true</tt> (and thus stops the dialog from closing) the handler will still be called, and its fourth argument will be set to <tt>true</tt> as well. Here's an example of how a no-close checker can be used to give an error message in case someone enters a value for the field with key <tt>inp</tt> that is empty or above 20 characters:
<?php hyperlight('function(button, fields)
	if button == DB.OK and (fields.inp == "" or fields.inp:len() > 20) then
		dialog.create("Your input must not be empty or longer than 20 characters.")
		return true
	end
end', 'generic'); ?>
Now the handler might be defined as follows:
<?php hyperlight('function(button, fields, identifier, notclosed)
	if notclosed then
		return
	end

	if button == DB.OK then
		-- Save your fields.inp here.
	end
end', 'generic'); ?>
You can find more examples in <tt>dialog_uses.lua</tt> in Ved, no-close checkers are generally prefixed <tt>_validate</tt>.

<h3>Fields</h3>
Each dialog can have a list of input fields that will be shown in the dialog. Each input field starts with the following sequential properties:
<ul>
	<li>Key (its identifier, like <tt>name</tt> in a HTML input field)</li>
	<li>X position in characters (blocks of 8)</li>
	<li>Y position in characters (blocks of 8)</li>
	<li>Width of input field in characters (so in blocks of 8 again)</li>
	<li>Default value (like <tt>value</tt> in HTML)</li>
	<li>Type (for example, use <tt>DF.TEXT</tt> for a text field)</li>
</ul>
<p>The X and Y positions for the field both start at 0, which is the position the regular dialog text also starts.<br>
These are the different types of input fields:</p>
<table border="1">
	<tr><td>0</td><td><tt>DF.TEXT</tt></td><td>Text input (this is the default)</td></tr>
	<tr><td>1</td><td><tt>DF.DROPDOWN</tt></td><td>Dropdown</td></tr>
	<tr><td>2</td><td><tt>DF.LABEL</tt></td><td>Plain text label (does not take input)</td></tr>
	<tr><td>3</td><td><tt>DF.CHECKBOX</tt></td><td>Checkbox</td></tr>
	<tr><td>4</td><td><tt>DF.RADIOS</tt></td><td>Radio button list</td></tr>
	<tr><td>5</td><td><tt>DF.FILES</tt></td><td>Files list and directory navigation</td></tr>
</table>
<p>The <tt>DF.</tt> constants were added in Ved 1.5.0. More information about how the different types work:</p>
<h4>(0) DF.TEXT - Text input</h4>
A text field is what it says it is. An example is given as follows: <?php hyperlight('{"name", 0, 1, 40, "", DF.TEXT}', 'generic', 'tt'); ?><br>
Here, the key is <tt>name</tt>, it is positioned on the start of the second line of text, it is 40 characters wide (but more characters will fit less elegantly) and its default value is an empty string.

<h4>(1) DF.DROPDOWN - Dropdown</h4>
Dropdowns require at least one more argument:
<ul>
	<li>A list of items shown in the dropdown menu</li>
	<li>An optional table that converts a value to a displayable &quot;current selection&quot; if you want to hide how the value is passed. If not given, set this to <tt>false</tt> if you also want to supply the next argument.</li>
	<li>An optional function that gets called whenever a selection is made from the dropdown. Think of an <tt>onchange</tt> event in HTML/JS. Gets passed the selection from the dropdown as text, and may return a substitute to fill into the input field behind the scenes.</li>
</ul>
<p>Basically, there's two forms: first the simpler one. In the simpler form, you only need a list of items that will appear in the dropdown, and whenever the user selects an item, the value of the input field is set to the text of the option that the user selected. This means what's readable as an option will be passed. You may want to set the default value to an option in the list.<br>
An example: <?php hyperlight('{"drop", 0, 0, 30, "Option A", DF.DROPDOWN, {"Option A", "Option B", "Option C"}}', 'generic', 'tt'); ?><br>
The width is set to 30 because that's how wide dropdown menus are (currently). If you want a function to be called every time an option is selected in this case, there'd be two more arguments: <tt>false</tt> (as a filler for the second table) and then the function.</p>
<p>For the second form, let's take the example of a user selecting between percentages, let's say 50%, 100% and 200%. You want to pass this as a number instead, so if the user selects 50%, you want the actual value to be <tt>0.5</tt>. When the user does select 50%, the &quot;onchange&quot; function is called, and converts the &quot;50%&quot; into <tt>0.5</tt>, and returns that. The second table that was mentioned (the one that converts a value to a displayable &quot;current selection&quot;) has this <tt>0.5</tt> background value as a key, and that maps to a value of &quot;50%&quot;.<br>
So this is that example:</p>
<?php hyperlight('{
	"drop2", 0, 2, 30, 0.5, DF.DROPDOWN, {"50%", "100%", "200%"}, {[0.5] = "50%", [1] = "100%", [2] = "200%"},
	function(picked)
		if picked == "50%" then
			return 0.5
		elseif picked == "100%" then
			return 1
		elseif picked == "200%" then
			return 2
		end
	end
}', 'generic'); ?>
<!--You might want to generate tables for this in some way instead of hardcoding them like that, and let the function iterate over the table or index one or something, to make it a bit more elegant.-->
<p>As of version 1.5.0, you can use the function <tt>generate_dropdown_tables(tuples)</tt> to generate these last three arguments. The function takes a table as an argument with key-value tuples as elements (not keys as keys and values as values). It returns the three required arguments for the second form (list of displayed items, converter key-value table and &quot;onchange&quot; function). For example, the previous example could be written more elegantly as follows:</p>
<?php hyperlight('{
	"drop2", 0, 2, 30, 0.5, DF.DROPDOWN, generate_dropdown_tables({{0.5, "50%"}, {1, "100%"}, {2, "200%"}})
}', 'generic'); ?>

<h4>(2) DF.LABEL - Plain text label</h4>
<p>This is just a bit of text that can be displayed anywhere in the dialog you want. It can therefore be used to label other input fields without having to include those labels in the dialog contents.</p>
<p>The &quot;default value&quot; will be used as text, but it can also be a function that returns the text dynamically.</p>
<p>An example for a plain-text label is as follows: <?php hyperlight('{"", 0, 5, 10, "Label", DF.LABEL}', 'generic', 'tt'); ?><br>
The key is left empty, because it has not much use. But we can't set it to <tt>nil</tt>, otherwise Lua might think the table ends there. It is positioned on the start of the 6th line. The width is 10 characters, which means it will merely wrap beyond that point. Then the label is just a string, and will be displayed. <tt>2</tt> is the type.</p>
<p>Here's an example of a label that keeps changing: <?php hyperlight('{"", 0, 5, 40, function() return love.math.random() end, DF.LABEL}', 'generic', 'tt'); ?><br>
This will continuously display a different random number between 0 and 1. Note that the key and the table of fields are passed to the function, but it's not used here.</p>

<h4>(3) DF.CHECKBOX - Checkbox</h4>
Checkboxes are useful for <tt>true</tt>/<tt>false</tt> values. The width of the checkbox is not the width of the actual checkbox, but the width of the clicking area. This is useful to make the label clickable as well.<br>
Example: <?php hyperlight('OPTIONLABEL = "Option"', 'generic', 'tt'); ?>
<?php hyperlight('
{"option", 0, 5, 2+font8:getWidth(OPTIONLABEL), true, DF.CHECKBOX},
{"", 2, 5, 40, OPTIONLABEL, DF.LABEL}', 'generic'); ?>
The default state of this checkbox is checked, since the default value is set to <tt>true</tt> here. It is followed by a plain text label (type 2), and the label can be clicked as well to toggle the checkbox.

<h4>(4) DF.RADIOS - Radio button list</h4>
<p>Radio buttons were added in Ved 1.5.0. These function exactly like dropdowns do, the only differences are the type and the way they behave in the GUI. The width argument is not used. You can use the same <tt>generate_dropdown_tables</tt> function for radio buttons that you can use for dropdowns.</p>
<p>For example, the time format picker in the language dialog works like this:</p>
<?php hyperlight('
		{
			"timeformat", 23, 8, 0, s.new_timeformat, DF.RADIOS,
			generate_dropdown_tables(
				{{24, "23:59"}, {12, "11:59pm"}}
			)
		},
', 'generic'); ?>
<p>The initial value is <tt>s.new_timeformat</tt>, which is the setting for the time format, which is either 24 or 12. Selecting &quot;23:59&quot; sets the value to 24, selecting &quot;11:59pm&quot; sets the value to 12. (Note that the dialog handler should apply the change, the value that you fill in as 5th argument is merely the initial state of the 'field'.)</p>

<h4>(5) DF.FILES - Files list and directory navigation</h4>
<p>The files list type was added in Ved 1.6.0. The default value is the full path to the current directory. It takes 7 more arguments (note that despite me giving each of these arguments names, they don't actually have keys by those names, and this is only to make it easier to understand):</p>
<ol>
	<li><tt>menuitems</tt> - A table of files, where each file is a table of the form returned by <tt>listfiles_generic()</tt>. That is, it has the attributes of <tt>name</tt>, <tt>isdir</tt>, and <tt>lastmodified</tt>.</li>
	<li><tt>folder_filter</tt> - If argument 7 (<tt>filter_on</tt>) is on, then the files listed will only be the ones ending in this string. Usually it'll be a file extension like <tt>.vvv</tt>. You can make this filter only directories by passing the operating system's directory separator, which should be <tt>dirsep</tt>.</li>
	<li><tt>folder_show_hidden</tt> - Whether or not to show hidden files or not. This is passed to <tt>listfiles_generic()</tt>, which goes off of the operating system's definition of hidden.</li>
	<li><tt>listscroll</tt> - The Y offset of the files list due to the scrollbar, as (indirectly) generated by <tt>scrollbar()</tt>.</li>
	<li><tt>folder_error</tt> - A string for indicating errors. It should be non-empty when there's an error.</li>
	<li><tt>list_height</tt> - The amount, in blocks of 8, of the list.</li>
	<li><tt>filter_on</tt> - Whether or not to apply the filename-ending filter from argument 2 (<tt>folder_filter</tt>).</li>
</ol>
<p>Note that you need a field with the key of "name" to select a file, and you need a checkbox to toggle showing only directories, showing only files that are filtered, or showing hidden files.</p>
<p>For this reason, it is recommended to make a full file selection dialog with <tt>dialog.form.files_make()</tt> instead. In fact, all code in Ved currently uses that function instead of making the files list manually.</p>
<dl>
<dt><?php hyperlight('dialog.form.files_make(startfolder, defaultname, filter, show_hidden, list_height)', 'generic', 'tt'); ?></dt>
<dd>
	<em>All of the arguments are required.</em><br>
	<tt>startfolder</tt> is the full file path to the folder you start the dialog in, just like the default value for <tt>DF.FILES</tt>.<br>
	<tt>defaultname</tt> is what to put as the default value for the "Name:" field.<br>
	<tt>filter</tt> will filter for filenames that end in this string, unless you pass it <tt>dirsep</tt>, in which case directories will be filtered instead. A checkbox toggling the filter will be created. If you decide to filter directories, then there will no longer be a "name"-key field.<br>
	<tt>show_hidden</tt> is whether or not to show hidden files, by the operating system's definition of hidden.<br>
	<tt>list_height</tt> is the height (in blocks of 8) of the list.
</dd>
</dl>

<h2>Dialogs (old, deprecated system, fully removed in Ved 1.5.2)</h2>
Dialog boxes in the system before Ved 1.4.0 can be created by calling <tt>dialog.new</tt>:
<dl>
<dt><?php hyperlight('dialog.new(message, title, showbar, buttons, questionid)', 'generic', 'tt'); ?></dt>
<dd>
	<tt>message</tt> is the body of the text box.<br>
	<tt>title</tt> will be shown in the title bar (if the title bar is shown by setting <tt>showbar</tt> to 1, which is always done in Ved. In fact, as of 1.4.0, the <tt>showbar</tt> parameter has no effect anymore). The title is often set to an empty string in Ved.<br>
	<tt>buttons</tt> decides what buttons are shown, and <tt>questionid</tt> decides what to do with the button that is pressed, 0 to take no action. The question ID system is not optimized for plugins, but the new dialog system allows plugins to specify their own question handlers for dialogs.
</dd>
</dl>
<h3>Dialog buttons</h3>
<p>The fourth argument of <tt>dialog.new</tt> (called <tt>buttons</tt> above) can be set to one of the following values V:</p>
<table border="1">
<tr><th>V</th><th>Button 3</th><th>Button 2</th><th>Button 1</th></tr>
<tr><td>0</td><td></td><td></td><td></td></tr>
<tr><td>1</td><td></td><td></td><td>OK</td></tr>
<tr><td>2</td><td></td><td></td><td>Quit</td></tr>
<tr><td>3</td><td></td><td>Yes</td><td>No</td></tr>
<tr><td>4</td><td></td><td>OK</td><td>Cancel</td></tr>
<tr><td>5</td><td>OK</td><td>Cancel</td><td>Apply</td></tr>
<tr><td>6</td><td>Save</td><td>Discard</td><td>Cancel</td></tr>
</table>
<p>(6 has been added in Ved 1.3.0)</p>

<h2><a name="textinput">Text input</a></h2>
<p>General text input can be started by a single call to <tt>startinput()</tt>. There's also a function <tt>startinputonce()</tt>, which can be used if you decide to do it in update/drawing code, but expect me to remove that sooner or later. Input can be stopped (or locked) by calling <tt>stopinput()</tt>. The text input to the left of the cursor can be found in <tt>input</tt>, and text to the right of the cursor can be found in <tt>input_r</tt>. The variable <tt>__</tt> (two underscores) contains the text cursor and the text to the right of it. So, to display the input field, you can concatenate <tt>input</tt> and <tt>__</tt> (<?php hyperlight('input .. __', 'generic', 'tt'); ?>).</p>

<p>It's also possible to include text boxes in dialogs, see the above part on fields in dialogs.</p>

<h2><a name="showhotkey">Hotkeys</a></h2>
<p>If you didn't know already, you can hold F9 to reveal hotkeys.</p>

Since Ved 1.6.1, Ved has had a dedicated function to display any hotkey on the screen if F9 is held down, <tt>showhotkey</tt>:
<dl>
<dt><?php hyperlight('showhotkey(hotkey, x, y, align, topmost, dialog_obj)', 'generic', 'tt'); ?></dt>
<dd>
	<tt>hotkey</tt> is the code (or sequence of codes) for the hotkey in question. More on what these codes are later. <em>This is required.</em><br>
	<tt>x</tt> is the x-position of the hotkey. <em>This is required.</em><br>
	<tt>y</tt> is the y-position of the hotkey. <em>This is required.</em><br>
	<tt>align</tt> can be either one of <tt>ALIGN.LEFT</tt> (default), <tt>ALIGN.CENTER</tt>, or <tt>ALIGN.RIGHT</tt>, and will align the hotkey appropriately.<br>
If you are calling this from a dialog, you will need to pass the next two arguments (and consequently, will need to pass <tt>align</tt> as well):<br>
	<tt>topmost</tt> is whether the given dialog is the topmost dialog or not. You should be in a <tt>cDialog</tt> drawing function and just pass the <tt>topmost</tt> from that function.<br>
	<tt>dialog_obj</tt> is the dialog object the hotkey is located on. You should be in a <tt>cDialog</tt> drawing function and just pass the <tt>self</tt> from that function.
</dd>
</dl>

<h3>Hotkey codes</h3>
<p>Each symbol in the hotkey font, <tt>tinynumbersfont</tt>, is actually mapped to one specific character, and is case-sensitive.</p>
<p>What this means is that, for example, <tt>a</tt> is Alt, but <tt>A</tt> is just the letter A. In fact, <tt>0</tt>-<tt>9</tt> and <tt>A</tt>-<tt>Z</tt> (uppercase) are all just themselves, along with a lot of other characters. You can also easily combine symbols togetter like so: <tt>aS</tt> would simply be Alt+S, and show up as such accordingly.</p>
<p>In the following list of usable symbols, a character is simply itself if it has no text saying otherwise:</p>
<ul>
	<li><tt>0</tt></li>
	<li><tt>1</tt></li>
	<li><tt>2</tt></li>
	<li><tt>3</tt></li>
	<li><tt>4</tt></li>
	<li><tt>5</tt></li>
	<li><tt>6</tt></li>
	<li><tt>7</tt></li>
	<li><tt>8</tt></li>
	<li><tt>9</tt></li>
	<li><tt>A</tt></li>
	<li><tt>B</tt></li>
	<li><tt>C</tt></li>
	<li><tt>D</tt></li>
	<li><tt>E</tt></li>
	<li><tt>F</tt></li>
	<li><tt>G</tt></li>
	<li><tt>H</tt></li>
	<li><tt>I</tt></li>
	<li><tt>J</tt></li>
	<li><tt>K</tt></li>
	<li><tt>L</tt></li>
	<li><tt>M</tt></li>
	<li><tt>N</tt></li>
	<li><tt>O</tt></li>
	<li><tt>P</tt></li>
	<li><tt>Q</tt></li>
	<li><tt>R</tt></li>
	<li><tt>S</tt></li>
	<li><tt>T</tt></li>
	<li><tt>U</tt></li>
	<li><tt>V</tt></li>
	<li><tt>W</tt></li>
	<li><tt>X</tt></li>
	<li><tt>Y</tt></li>
	<li><tt>Z</tt></li>
	<li><tt>,</tt></li>
	<li><tt>.</tt></li>
	<li><tt>~</tt> is blank, and simply adds a bit of extra space.</li>
	<li><tt>{</tt> is a flag, facing right.</li>
	<li><tt>}</tt> is an arrow, pointing right. (This is different from <tt>x</tt> because this arrow's vertical position is at the top of the line.)</li>
	<li><tt>c</tt> is Ctrl. This is the Cmd symbol on macOS, Strg if your language is set to German, and the Cmd symbol if your language is set to German on macOS.</li>
	<li><tt>s</tt> is Shift.</li>
	<li><tt>a</tt> is Alt.</li>
</ul>
The top row of letters of the QWERTY keyboard, lowercase, along with <tt>k</tt> and <tt>l</tt>, is F1-F12. Here they are for reference:
<ul>
	<li><tt>q</tt> is F1.</li>
	<li><tt>w</tt> is F2.</li>
	<li><tt>e</tt> is F3.</li>
	<li><tt>r</tt> is F4.</li>
	<li><tt>t</tt> is F5.</li>
	<li><tt>y</tt> is F6.</li>
	<li><tt>u</tt> is F7.</li>
	<li><tt>i</tt> is F8.</li>
	<li><tt>o</tt> is F9.</li>
	<li><tt>p</tt> is F10.</li>
	<li><tt>k</tt> is F11.</li>
	<li><tt>l</tt> is F12.</li>
</ul>
<ul>
	<li><tt>&lt;</tt></li>
	<li><tt>&gt;</tt></li>
	<li><tt>/</tt></li>
	<li><tt>[</tt></li>
	<li><tt>]</tt></li>
	<li><tt>z</tt> is an arrow pointing left.</li>
	<li><tt>x</tt> is an arrow pointing right. (This is different from <tt>}</tt> because this arrow is vertically centered in the line, as opposed to <tt>}</tt>.)</li>
	<li><tt>n</tt> is the arrow symbol for Return, or Enter.</li>
	<li><tt>b</tt> is Esc.</li>
	<li><tt>f</tt> is Tab.</li>
	<li><tt>+</tt></li>
	<li><tt>-</tt></li>
</ul>

<h2><a name="eastereggs">Easter eggs</a></h2>
Ved contains several easter eggs.

</body>
</html>
