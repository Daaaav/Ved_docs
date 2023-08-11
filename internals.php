<?php
require('hyperlight.php');
?><!DOCTYPE html>
<html>
<head>
<title>Ved technical documentation</title>
<link rel="icon" href="/ved/favicon.ico" sizes="16x16 32x32 48x48 64x64">
<style>
td, th {
	padding: 4px;
}

.blu {
	color: blue;
}

.dred {
	color: red;
	text-decoration: line-through;
}

tr.cellborders > td {
	border: 1px solid black;
}

h2 {
	border-bottom: 1px solid #333;
}

.unsupported_bg {
	background-color: tomato;
}

.supported_bg {
	background-color: lightGreen;
}

.warnsupported_bg {
	background-color: gold;
}

/*
h2 > a::after {
	content: "<a href=\"#" attr(name) "\">#</a>";
}
*/

a#page_internals {
	font-weight: bold;
}

.br_bigger {
	display: block;
	margin-bottom: 0.5em;
}

div.outdated_but_still_include_for_now {
	border: 1px solid gray;
	padding: 0 0.75em;
	color: gray;
}

.not_outdated {
	color: black;
}
</style>
<link rel="stylesheet" type="text/css" href="colors/customizedstyle.css?020217" id="theme">
</head>
<body>
<?php include('links.php'); ?>
<h1>Ved technical documentation</h1>
<p>This page is intended to document Ved's internals as well as possible. The page is still being worked on, and more things are being added over time. If you'd like to know more about anything specific in Ved that I haven't explained yet here, or not well enough (except for the easter eggs :P), feel free to ask! If you'd like more information on how to make plugins, check <a href="plugins.php" target="_blank">this page</a>. The repository is <a href="https://gitgud.io/Dav999/ved" target="_blank">here</a>.</p>
<p>Last updated: <strong><?php echo date('l j F Y H:i (T)', filemtime('ved_docs/internals.php')); /* previously getlastmod() */ ?></strong> (this is the last edit date of the file)</p>

<h2><a name="files">Files</a></h2>
<p>The following source files are used in Ved. Note that this table may not be entirely accurate - the &quot;Added&quot; column may not always be filled in even if a file didn't exist since the early days of Ved for example, some files may have been removed from the list altogether when they were removed, some changes may not yet have been documented here, and some files may have had more complicated overhauls. Version numbers in parentheses indicate that basically, the file had either been renamed, or something else is the matter that should be explained in the description.</p>
<table border="1">
<tr><th>Filename</th><th>Added</th><th>Rem'd</th><th>Description</th></tr>
<tr><td><tt>callback_*.lua</tt></td><td>1.8.4</td><td></td><td>Contain all <tt>love.*</tt> callbacks. For example, <tt>callback_load.lua</tt> loads most other source files and assets.</td></tr>
<tr><td><tt>clargs.lua</tt></td><td></td><td></td><td>Stores and formats the command line help output when requested.</td></tr>
<tr><td><tt>conf.lua</tt></td><td></td><td></td><td>L&Ouml;VE's configuration file, controlling default window settings and loaded L&Ouml;VE modules.</td></tr>
<tr><td><tt>const.lua</tt></td><td></td><td></td><td>Constants - Contains known scripting commands, music names, and other lookup tables. Also contained tileset data before 1.8.4.</td></tr>
<tr><td><tt>coordsdialog.lua</tt></td><td>1.4.0</td><td></td><td>Contains code related to the little room coordinates input after hitting Q in the main editor. Before 1.4.0, this was part of <tt>dialog.lua</tt>.</td></tr>
<tr><td><tt>corefunc.lua</tt></td><td></td><td></td><td>Contains a few functions that are used so early in loading (and/or are used on the crash screen), they must exist before things like plugins and the error handler are loaded.</td></tr>
<tr><td><tt>coretext.lua</tt></td><td></td><td></td><td>Contains functions for loading fonts, language files, and printing text.</td></tr>
<tr><td><tt>devstrings.lua</tt></td><td></td><td></td><td>Used for defining new text strings during development of a new version, before putting them in all the language files.</td></tr>
<tr><td><tt>dialog.lua</tt></td><td></td><td></td><td>Contains code related to dialog boxes. Before 1.4.0, this also contained code for right click menus, scrollbars and VVVVVV-style text boxes, which have each been moved to their own separate files as of 1.4.0.</td></tr>
<tr><td><tt>dialog_uses.lua</tt></td><td></td><td></td><td>Contains callback functions and definitions of fields for dialogs, which are used as arguments for <tt>dialog.create(...)</tt></td></tr>
<tr><td class="dred"><tt>drawhelp.lua</tt></td><td></td><td>1.8.4</td><td>Holds <tt>drawhelp()</tt>, called by <tt>love.draw()</tt> in state 15 (the help state). The help system is also used for level notes and the plugins list.<br>As of 1.8.4, this code was moved to <tt>uis/help/draw.lua</tt>.</td></tr>
<tr><td class="dred"><tt>drawlevelslist.lua</tt></td><td></td><td>1.8.4</td><td>Holds <tt>drawlevelslist()</tt>, called by <tt>love.draw()</tt> in state 6 (the loading screen state).<br>As of 1.8.4, this code was moved to <tt>uis/levelslist/draw.lua</tt>.</td></tr>
<tr><td class="dred"><tt>drawmaineditor.lua</tt></td><td></td><td>1.8.4</td><td>Holds <tt>drawmaineditor()</tt>, called by <tt>love.draw()</tt> in state 1 (the main editor state).<br>As of 1.8.4, this code was moved to <tt>uis/maineditor/draw.lua</tt>.</td></tr>
<tr><td class="dred"><tt>drawmap.lua</tt></td><td></td><td>1.8.4</td><td>Holds <tt>drawmap()</tt>, called by <tt>love.draw()</tt> in state 12 (the map state).<br>As of 1.8.4, this code was moved to <tt>uis/map/draw.lua</tt>.</td></tr>
<tr><td class="dred"><tt>drawscripteditor.lua</tt></td><td></td><td>1.8.4</td><td>Holds <tt>drawscripteditor()</tt>, called by <tt>love.draw()</tt> in state 3 (the script editor state).<br>As of 1.8.4, this code was moved to <tt>uis/scripteditor/draw.lua</tt>.</td></tr>
<tr><td class="dred"><tt>drawsearch.lua</tt></td><td></td><td>1.8.4</td><td>Holds <tt>drawsearch()</tt>, called by <tt>love.draw()</tt> in state 11 (the search state).<br>As of 1.8.4, this code was moved to <tt>uis/search/draw.lua</tt>.</td></tr>
<tr><td><tt>entity_mousedown.lua</tt></td><td>1.9.0</td><td></td><td>Contains <tt>handle_entity_mousedown()</tt>. Handles (right) clicking on entities and creating right click menus for them.</td></tr>
<tr><td><tt>errorhandler.lua</tt></td><td></td><td></td><td>Contains code for both the crash screen and the plugin error screen.</td></tr>
<tr><td><tt>filefunc_linmac.lua</tt></td><td>1.5.0</td><td></td><td>Since Ved 1.5.0, this contains functions necessary for accessing the VVVVVV levels and graphics folders on Linux and macOS. This uses the <tt>vedlib_filefunc_*</tt> library found in the <tt>libs</tt> folder via LuaJIT FFI.<br>Before Ved 1.5.0, this was split in <tt>filefunc_lin.lua</tt> and <tt>filefunc_mac.lua</tt> and used terminal utilities to list level files.<br>Before Ved 1.10.0, on Linux this library was only ever compiled locally. If unsuccessful (due to missing <tt>gcc</tt>) we'd fallback to <tt>filefunc_lin_fallback.lua</tt> instead. Now a compiled Linux version is provided (just like for macOS), with local compilation as a fallback.</td></tr>
<tr><td class="dred"><tt>filefunc_lin_fallback.lua</tt></td><td>(1.5.0)</td><td>1.10.0</td><td>Contained functions necessary for accessing the VVVVVV levels and graphics folders on Linux, if compiling the filefunc library was not successful (due to missing <tt>gcc</tt>). This used command line utilities like <tt>ls</tt> to list level files and some other file-related things.<br>Before 1.5.0, this file was called <tt>filefunc_lin.lua</tt>, because this was the only method that existed.</td></tr>
<tr><td><tt>filefunc_luv.lua</tt></td><td></td><td></td><td>Contains fallback <tt>love.filesystem</tt> functions for accessing fallback levels and graphics folders if the operating system is something other than Windows, macOS or Linux.</td></tr>
<tr><td class="dred"><tt>filefunc_mac.lua</tt></td><td></td><td>1.5.0</td><td>Contained functions necessary for accessing the VVVVVV levels and graphics folders on macOS. Used command line utilities like <tt>ls</tt> to list level files and some other file-related things.</td></tr>
<tr><td><tt>filefunc_win.lua</tt></td><td></td><td></td><td>Contains functions necessary for accessing the VVVVVV levels and graphics folders on Windows. As of Ved 1.5.0, this uses the Windows API for everything (including reading and writing level files, due to <tt>io.open</tt> being non-Unicode on Windows), before 1.5.0, it used command line utilities like <tt>dir</tt>.</td></tr>
<tr><td><tt>func.lua</tt></td><td></td><td></td><td>Contains many functions, especially general-purpose ones and core Ved functions.</td></tr>
<tr><td><tt>helpfunc.lua</tt></td><td></td><td></td><td>Contains certain functions related to (editing) level notes, and the rest of the help system.</td></tr>
<tr><td><tt>https_*.lua</tt></td><td>1.8.3<br>1.8.4</td><td></td><td>Contains platform-specific code for making HTTPS requests.<br>These files were added in Ved 1.8.3 and 1.8.4.</td></tr>
<tr><td class="dred"><tt>imagefont.lua</tt></td><td>1.4.0</td><td>1.10.0</td><td>Loads and readies <tt>font.png</tt> for use inside Ved.<br>In Ved 1.10.0, this was superseded by <tt>vedfont.lua</tt>.</td></tr>
<tr><td><tt>incompatmain8.lua</tt></td><td>(1.4.5)</td><td></td><td>If L&Ouml;VE 0.8 or lower is used, this is loaded from <tt>main.lua</tt>. It displays a message that outdated L&Ouml;VE is being used in all available languages.<br>Before Ved 1.4.5, this file was called <tt>incompatmain.lua</tt>.</td></tr>
<tr><td><tt>incompatmain9.lua</tt></td><td>1.4.5</td><td></td><td>If L&Ouml;VE 0.9.0 is used, this is loaded from <tt>main.lua</tt>. It displays a message that L&Ouml;VE 0.9.0 is no longer supported in all available languages.</td></tr>
<tr><td><tt>input.lua</tt></td><td>1.8.0</td><td></td><td>Contains <a href="https://gitgud.io/Dav999/ved/merge_requests/31" target="_blank">the new input system</a>.</td></tr>
<tr><td><tt>konami.lua</tt></td><td>(1.8.4)</td><td></td><td>Handles the shortcut that can be used in the help screen to make text editable. Before Ved 1.8.4, this file was called <tt>keyfunc.lua</tt>.</td></tr>
<tr><td><tt>librarian.lua</tt></td><td>1.10.0</td><td></td><td>Provides <tt>prepare_library</tt> and <tt>load_library</tt>, which make sure necessary libraries are ready for use, and can load them.</td></tr>
<tr><td><tt>libs/</tt></td><td></td><td></td><td>Folder containing some C and Objective-C support libraries for Linux and macOS, and C header files for those libraries and parts of the Windows API, for use with LuaJIT FFI.</td></tr>
<tr><td><tt>loadallmetadata.lua</tt></td><td></td><td></td><td>Returns level metadata for the levels list from a different thread.</td></tr>
<tr><td><tt>loadconfig.lua</tt></td><td></td><td></td><td>Handles anything related to the settings.</td></tr>
<tr><td><tt>love10compat.lua</tt></td><td></td><td></td><td>Loaded only when L&Ouml;VE 0.10.0 or higher is used, and provides compatibility with those versions. Contains the new <tt>love.wheelmoved</tt> callback.</td></tr>
<tr><td><tt>love11compat.lua</tt></td><td></td><td></td><td>Loaded only when L&Ouml;VE 11.0 or higher is used, and provides compatibility with those versions. For example, this hijacks color functions so they work with 0-255 instead of 0-1.</td></tr>
<tr><td><tt>main.lua</tt></td><td></td><td></td><td>The first file that is loaded. Loads the fonts, sets a few basic variables, and loads <tt>plugins.lua</tt>, <tt>errorhandler.lua</tt> and, most importantly, all the <tt>callback_*.lua</tt> files (or <tt>main2.lua</tt> before 1.8.4).</td></tr>
<tr><td class="dred"><tt>main2.lua</tt></td><td></td><td>1.8.4</td><td>Contained all the L&Ouml;VE callbacks that are now split into <tt>callback_*.lua</tt> files.</td></tr>
<tr><td><tt>mapfunc.lua</tt></td><td>1.4.2</td><td></td><td>Contains functions related to rendering and updating the map overview screen.</td></tr>
<tr><td><tt>music.lua</tt></td><td>1.6.0</td><td></td><td>Handles reading and writing <tt>vvvvvvmusic.vvv</tt>, <tt>mmmmmm.vvv</tt>, and other custom music files.</td></tr>
<tr><td><tt>ogg_vorbis_metadata.lua</tt></td><td>1.9.0</td><td></td><td>Decodes some metadata from Ogg Vorbis files, like sample rate, and Vorbis comments (for loop points).</td></tr>
<tr><td><tt>playtesting.lua</tt></td><td>1.8.0</td><td></td><td>Contains code relevant to playtesting in VVVVVV.</td></tr>
<tr><td><tt>playtestthread.lua</tt></td><td>1.8.0</td><td></td><td>The thread that starts up VVVVVV (dependent on OS of course) and waits for it to be closed.</td></tr>
<tr><td><tt>plugins.lua</tt></td><td></td><td></td><td>Makes sure plugins and their file edits and hooks are loaded</td></tr>
<tr><td><tt>resizablebox.lua</tt></td><td></td><td></td><td>Has a system for a box that can be resized by dragging borders with the mouse. Was formerly used for resizing script boxes, but it was glitchy so it's now unused.</td></tr>
<tr><td><tt>rightclickmenu.lua</tt></td><td>1.4.0</td><td></td><td>Contains code related to right click menus. Before 1.4.0, this was part of <tt>dialog.lua</tt>.</td></tr>
<tr><td><tt>roomfunc.lua</tt></td><td></td><td></td><td>Contains functions related to rooms in levels, tiles and such.</td></tr>
<tr><td><tt>scaling.lua</tt></td><td></td><td></td><td>Hijacks/Decorates a couple of L&Ouml;VE functions to make scaling work perfectly</td></tr>
<tr><td><tt>scriptfunc.lua</tt></td><td></td><td></td><td>Contains functions related to scripts.</td></tr>
<tr><td><tt>scrollbar.lua</tt></td><td>1.4.0</td><td></td><td>Contains code related to scrollbars. Before 1.4.0, this was part of <tt>dialog.lua</tt>.</td></tr>
<tr><td><tt>searchfunc.lua</tt></td><td></td><td></td><td>Contains functions related to searching levels.</td></tr>
<tr><td><tt>slider.lua</tt></td><td></td><td></td><td>Used for the number controls like in the options screen</td></tr>
<tr><td><tt>tileset_data.lua</tt></td><td></td><td></td><td>Contains tile numbers for all tilesets.</td></tr>
<tr><td><tt>tool_mousedown.lua</tt></td><td>1.9.0</td><td></td><td>Contains <tt>handle_tool_mousedown()</tt>. Handles general clicking on the canvas in the main editor, including all the tools, and placing down moved entities. Excludes (right) clicking on entities, see <tt>handle_entity_mousedown()</tt> (<tt>entity_mousedown.lua</tt>) for that.</td></tr>
<tr><td><tt>ui_elements.lua</tt></td><td>1.7.0</td><td></td><td>Contains all the <a href="#guielements">GUI elements</a></td></tr>
<tr><td><tt>uis/</tt></td><td>1.7.0</td><td></td><td>Folder with UI files for each state (see below).<br>Note that in 1.8.4, each state was changed from a single file to a folder with each callback in its own file.</td></tr>
<tr><td><tt>updatecheck.lua</tt></td><td>(1.8.4)</td><td></td><td>Contains functionality for the update check.<br>This file was added in Ved 1.8.4-pre14. Before, this filename was used for the actual update checking thread (see <tt>updatecheckthread.lua</tt>)</td></tr>
<tr><td><tt>updatecheckthread.lua</tt></td><td>(1.8.4)</td><td></td><td>Checks what the latest version of Ved is via HTTPS, and reports back. This is run inside a separate thread.<br>Before Ved 1.8.4-pre14, <em>this</em> file was called <tt>updatecheck.lua</tt>.</td></tr>
<tr><td><tt>utf8lib_*.lua</tt></td><td></td><td></td><td>Implements or supplements necessary parts of the Lua <tt>utf8</tt> module, depending on L&Ouml;VE version</td></tr>
<tr><td><tt>vedfont.lua</tt></td><td>1.10.0</td><td></td><td>Contains the font class implementing text rendering (instead of using <tt>love.graphics</tt> <tt>Font</tt> objects.)</td></tr>
<tr><td><tt>vvvvvvfunc.lua</tt></td><td></td><td></td><td>Implements some code from VVVVVV in Lua, mostly for displaying accurate colors.</td></tr>
<tr><td><tt>vvvvvv_textbox.lua</tt></td><td>1.4.0</td><td></td><td>Contains code related to VVVVVV-style text boxes. Before 1.4.0, this was part of <tt>dialog.lua</tt>.</td></tr>
<tr><td><tt>vvvvvvxml.lua</tt></td><td></td><td></td><td>Loads and parses levels from .vvvvvv level files, and creates and saves them. Also has a function for &quot;loading&quot; a blank level.</td></tr>
</table>

<h2><a name="states">States</a></h2>
<p>Ved uses state numbers to represent different screens, menus and interfaces. <!--(note about state and oldstate and functions)--> <span class="blu">Blue</span> state numbers are not normally used anymore, and/or are not normally accessible, and many of them are leftover testing states. <span class="dred">Red, struck-through</span> state numbers have been removed from Ved altogether (and won't be reused).</p>
<p>As of 1.8.2, most of the code specific to each state can be found in the <tt>uis/</tt> directory. States have their own versions of L&Ouml;VE callbacks (such as <?php hyperlight('ui.update(dt)', 'generic', 'tt'); ?>, <?php hyperlight('ui.keypressed(key)', 'generic', 'tt'); ?>, <?php hyperlight('ui.mousepressed(x, y, button)', 'generic', 'tt'); ?>, etc). Furthermore, user interfaces can be built up of &quot;Elements&quot; which may automatically implement their own callbacks based on their parameters and position. For example, buttons can be defined to automatically be drawn at the correct position, and to execute the same action when it is clicked and when a given shortcut is pressed. For more information, see the <a href="#guielements">GUI elements</a> section. It should be noted that states can also implement <?php hyperlight('ui.draw()', 'generic', 'tt'); ?>, which is called before the Elements are drawn.</p>
<table border="1">
<tr><th>#</th><th>UI name</th><th>Description</th></tr>
<tr><td class="blu">-3</td><td></td><td>Black screen</td></tr>
<tr><td>-2</td><td>init</td><td>tostate 6</td></tr>
<tr><td class="dred">-1</td><td></td><td>Display error (expected: errormsg)</td></tr>
<tr><td class="blu">0</td><td>state0</td><td>Jump to any state number you want. Can be accessed in debug mode by pressing F12.</td></tr>
<tr><td>1</td><td></td><td>The editor (will expect things to have been loaded)</td></tr>
<tr><td class="dred">2</td><td></td><td>Syntax highlighting test</td></tr>
<tr><td>3</td><td>scripteditor</td><td>Scripting editor</td></tr>
<tr><td class="dred">4</td><td></td><td>Some XML testing</td></tr>
<tr><td class="blu">5</td><td>fsinfo</td><td>Filesystem info</td></tr>
<tr><td>6</td><td>levelslist</td><td>Listing of all files in the levels folder, and load a level from here (loading screen)</td></tr>
<tr><td class="blu">7</td><td>spriteview</td><td>Display all sprites from sprites.png where you can get the number of the sprite you're hovering over</td></tr>
<tr><td class="dred">8</td><td></td><td>Ancient save screen (you can type in a name and press enter)</td></tr>
<tr><td class="blu">9</td><td>dialogtest</td><td>Dialog test, and right click menu test</td></tr>
<tr><td>10</td><td>scriptlist</td><td>List of scripts, and enter one to load</td></tr>
<tr><td>11</td><td>search</td><td>Search</td></tr>
<tr><td>12</td><td>map</td><td>Map</td></tr>
<tr><td>13</td><td>options</td><td>Options screen</td></tr>
<tr><td class="blu">14</td><td>enemypickertest</td><td>Enemy picker preview</td></tr>
<tr><td>15</td><td>help</td><td>Help/Level notes/Plugins list</td></tr>
<tr><td class="dred">16</td><td></td><td>Reserved for scroll bar test, never used</td></tr>
<tr><td class="dred">17</td><td></td><td>Reserved for folderopendialog utility, never used</td></tr>
<tr><td class="blu">18</td><td>unreinfo</td><td>Show main editor undo/redo stacks</td></tr>
<tr><td>19</td><td>scriptflags</td><td>Flags list</td></tr>
<tr><td class="blu">20</td><td>resizableboxtest</td><td>Resizable box test</td></tr>
<tr><td class="dred">21</td><td>overlapentinfo</td><td>Display overlapping entities (may be a visible function later) (maybe doesn't work properly)</td></tr>
<tr><td class="dred">22</td><td></td><td>Load a script file in the 3DS format (lines separated by dollars)</td></tr>
<tr><td class="dred">23</td><td></td><td>Load a script file NOT in the 3DS format (lines separated by \r\n or \n)</td></tr>
<tr><td class="dred">24</td><td></td><td>Simple plugins list (already never used)</td></tr>
<tr><td>25</td><td>syntaxoptions</td><td>Syntax highlighting color settings</td></tr>
<tr><td class="blu">26</td><td>fonttest</td><td>Font test</td></tr>
<tr><td>27</td><td>displayoptions</td><td>Display/Scale settings</td></tr>
<tr><td>28</td><td>levelstats</td><td>Level stats</td></tr>
<tr><td class="blu">29</td><td>pluralformstest</td><td>Plural forms test</td></tr>
<tr><td>30</td><td>assetsmenu</td><td>Assets viewer main menu</td></tr>
<tr><td>31</td><td>audioplayer</td><td>Music player/editor, sound player</td></tr>
<tr><td>32</td><td>graphicsviewer</td><td>Graphics viewer</td></tr>
<tr><td>33</td><td>language</td><td>Language screen</td></tr>
<tr><td class="blu">34</td><td>inputtest</td><td>New input system test</td></tr>
<tr><td>35</td><td>vvvvvvsetupoptions</td><td>&quot;VVVVVV setup&quot; options</td></tr>
<tr><td colspan="3">100 and further can be allocated by plugins (next paragraph)</td></tr>
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
	statecaught = true -- <- only necessary in 1.8.1 and older!
elseif in_astate("my_1st_plug", 1) then
	-- Insert drawing code for second state!
	statecaught = true
elseif in_astate("my_1st_plug", 2) then
	-- Insert drawing code for third state!
	statecaught = true
end', 'generic'); ?>
<p>The hook <tt>func_loadstate</tt> could contain something similar for initialization code for all the states (but without <?php hyperlight('statecaught = true', 'generic', 'tt'); ?>). Speaking about <?php hyperlight('statecaught = true', 'generic', 'tt'); ?>, this variable was used to prevent an &quot;Unknown state&quot; screen from showing, but this screen has been removed in 1.8.2, and thus setting the variable is no longer necessary.</p>
<p>The identifying name can be anything, but this name should be unique to one plugin. It's also possible to allocate multiple blocks of state numbers within the same plugin, if you use different names. If your plugin only has one state, you can leave out the number (<?php hyperlight('allocate_states("my_1st_plug")', 'generic', 'tt'); ?>, <?php hyperlight('in_astate("my_1st_plug")', 'generic', 'tt'); ?>, <?php hyperlight('to_astate("my_1st_plug")', 'generic', 'tt'); ?>). And of course, this means you can have multiple states that are only referred to by string names (I can see how <?php hyperlight('in_astate("my_1st_plug_menu")', 'generic', 'tt'); ?> and <?php hyperlight('in_astate("my_1st_plug_display")', 'generic', 'tt'); ?> can be more pleasing than <?php hyperlight('in_astate("my_1st_plug", 0)', 'generic', 'tt'); ?> and <?php hyperlight('in_astate("my_1st_plug", 1)', 'generic', 'tt'); ?>). It's up to you to choose whatever you like most, or whatever works best for your plugin.</p> 

<h2><a name="loveversioncompat">L&Ouml;VE version compatibility</a></h2>
<p>Ved is compatible with all revisions of L&Ouml;VE 0.9.x, 0.10.x and 11.x (except L&Ouml;VE 0.9.0 as of Ved 1.4.2), but its code is written for 0.9.x. Compatibility with newer versions is mostly achieved by causing update changes to be undone; for example, L&Ouml;VE functions that were renamed or expect different arguments are redefined/hijacked and then called by those redefinitions if arguments or return values need to be passed differently, and callbacks that get "new-style" data from L&Ouml;VE get a bit of conversion code at the top. There are a few instances of conditionals depending on the version number in regular code, but that is not very common.</p>

<p>In summary: (the unsupported features per version are more detailed below)</p>

<table border="1">
<tr><th>L&Ouml;VE</th><th>Ved support</th></tr>
<!--<tr><td class="warnsupported_bg">12.0</td><td>Not officially supported yet (hasn't been released)</td></tr>-->
<tr><td class="supported_bg">11.4</td><td rowspan="5">Supported since 1.3.3</td></tr>
<tr><td class="supported_bg">11.3</td></tr>
<tr><td class="supported_bg">11.2</td></tr>
<tr><td class="supported_bg">11.1</td></tr>
<tr><td class="supported_bg">11.0</td></tr>
<tr><td class="supported_bg">0.10.2</td><td rowspan="3">
	Supported since a42, with the following restriction:
	<ul>
		<li>Loop points (Ved 1.10.0+) in the music player do not work</li>
	</ul>
</td></tr>
<tr><td class="supported_bg">0.10.1</td></tr>
<tr><td class="supported_bg">0.10.0</td></tr>
<tr><td class="supported_bg">0.9.2</td><td rowspan="2">
	Supported, with the following restrictions:
	<ul>
		<li>The music player can't show song durations before playing</li>
		<li>The plugin hooks love_filedropped and love_directorydropped are never called</li>
		<li>Loop points (Ved 1.10.0+) in the music editor do not work</li>
	</ul>
</td></tr>
<tr><td class="supported_bg">0.9.1</td></tr>
<tr><td class="unsupported_bg">0.9.0</td><td>Support dropped in 1.4.5 (broken since 1.4.2)</td></tr>
<tr><td class="unsupported_bg">0.8.0-</td><td>Has never been supported, but a message is shown</td></tr>
</table>

<h3>Checking the L&Ouml;VE version Ved is running under</h3>
<p>Ved has a dedicated function to check if the current L&Ouml;VE version is at least a certain version or later, <tt>love_version_meets()</tt>. E.g. <tt>love_version_meets(10)</tt> means "L&Ouml;VE version is 0.10.0 or later", <tt>love_version_meets(9, 2)</tt> means "L&Ouml;VE version is 0.9.2 or later". It automatically takes care of the difference between 0.x and 11.x, too, so <tt>love_version_meets(10)</tt> means "L&Ouml;VE version is 0.10.0 or later" while <tt>love_version_meets(11)</tt> means "L&Ouml;VE version is 11.0 or later".</p>

<h3>Features unsupported in older L&Ouml;VE versions</h3>
<p>Nevertheless, there are simply some features or improved behavior added in later L&Ouml;VE versions, which Ved takes advantage of, that simply can't be backported to previous L&Ouml;VE versions. None of these are particularly important features for Ved's main purpose of editing levels, but it is still good to document them.</p>

<div class="outdated_but_still_include_for_now">
	<p class="not_outdated">The restrictions in this block only apply to Ved 1.9.1 and older. Due to different reasons, it has been possible to remove them in Ved 1.10.0.</p>

	<p><strong>Being able to use <tt>font.png</tt> from the VVVVVV graphics folder as the main font</strong><br>
	<em>This feature is only supported in L&Ouml;VE versions <strong>0.10.0 and up</strong>.</em></p>

	<p>This is because in L&Ouml;VE versions previous to 0.10.0, the font returned by <a href="https://love2d.org/wiki/love.graphics.newImageFont" target="_blank"><tt>love.graphics.newImageFont()</tt></a> automatically had 1 pixel of extra horizontal spacing, and there was no way to change this. If you used a custom <tt>font.png</tt> with 1 pixel of extra spacing for each glyph, it would look really ugly, partly because you wouldn't be used to it being rendered that way, but mostly because Ved prints text assuming there's no 1 pixel of extra space for each glyph.</p>
	<p>This problem is fixed in L&Ouml;VE 0.10.0+ because it added an optional third argument to <tt>love.graphics.newImageFont()</tt> to specify the spacing, which also lets you use negative values.</p>
	<p>On a side note, <tt>tinynumbers</tt>, Ved's F9 hotkey font, doesn't have this problem. This is because of a semi-hacky workaround: the font image is intentionally made with 1 less pixel of space per glyph, and then when it gets passed to <tt>love.graphics.newImageFont()</tt>, it gets 1 pixel of extra spacing either because it's below L&Ouml;VE 0.10.0 and it's forced or because we've specified 1 pixel of spacing in L&Ouml;VE 0.10.0+.</p>

	<p class="not_outdated">Ved 1.10.0 added its own text renderer, which supersedes TTF and ImageFont, so we no longer have any forced spacing and this now works in all L&Ouml;VE versions.</p>

	<p><strong>Having the F9 hotkey font change depending on operating system, language, etc.</strong><br>
	<em>This feature is only supported in L&Ouml;VE versions <strong>0.10.0 and up</strong>.</em></p>

	<p>This is referring to the feature where the characters on the hotkeys that show up when you hold down F9 will change to match your operating system and language. This means that, for example, Ctrl will change to &#x2318; (Cmd) on macOS, and Ctrl will change to Strg if your language is German. (If you're a German macOS user then it will still be &#x2318;.)</p>
	<p>This feature depends on <a href="https://love2d.org/wiki/Font:setFallbacks" target="_blank"><tt>Font:setFallbacks()</tt></a>, which was only added in L&Ouml;VE 0.10.0. Not much we can do without it.</p>

	<p class="not_outdated">Ved 1.10.0 added its own text renderer, which supersedes TTF and ImageFont, so we no longer need to rely on <tt>Font:setFallbacks()</tt> and this now works in all L&Ouml;VE versions.</p>

	<p><strong>Basically anything to do with jumping around the track of the currently playing audio in the music and sound effect viewers</strong><br>
	<em>This feature is only supported in L&Ouml;VE versions <strong>0.10.0 and up</strong>.</em></p>

	<p>In L&Ouml;VE versions before 0.10.0, you can't jump around the track of the currently playing music or sound effect. That means you cannot click on the track to go to a certain position, nor can you use (Shift)+(kp)Left/Right to move 5 or 10 seconds forwards or backwards.</p>
	<p>The reason is simple: we need to know the duration of the currently playing audio. The only function that does this is <a href="https://love2d.org/wiki/Source:getDuration" target="_blank"><tt>Source:getDuration()</tt></a>, and it only exists starting in L&Ouml;VE 0.10.0.</p>
	<p>Without knowing the duration of the audio, clicking on the track becomes meaningless, because one end is supposed to be the start of the audio (time t=0) and the other end is supposed to be the end of the audio (time t&#61;&lt;<!-- probably shouldn't use '=' next to '&lt;' here directly, because PHP -->duration of audio&gt;). Without the duration, we don't know what timecode the other end should be. So if one song is, let's say, 2:30 long and the other is 5:00 long, then in the 5:00-long song the middle of the track is 2:30, and in the 2:30-long song the middle of the track is 1:15 - but without knowing the duration of each we don't know where each timecode is supposed to be placed on the track for each song.</p>
	<p>Another consequence of not knowing the duration is that we can't make sure that you don't go past the end of the track when you use (Shift)+(kp)Left/Right to jump around. The end of the track is determined by its duration, which we don't know. So we wouldn't know if you went past the end or not without knowing the duration of the audio.</p>

	<p class="not_outdated">Ved 1.10.0 creates a temporary SoundData object when playing a song in L&Ouml;VE 0.9.x, which does have a <a href="https://love2d.org/wiki/SoundData:getDuration" target="_blank"><tt>:getDuration()</tt></a> method in 0.9.x. This means now the only restrictions in the music player/editor in LÖVE 0.9.x are that you can't see the duration of songs before playing them for the first time, and the songs take a little longer to start playing.</p>
</div>

<p><strong>Loop points in the music player/editor</strong><br>
<em>This feature is only supported in L&Ouml;VE versions <strong>11.0 and up</strong>.</em></p>

<p>Ogg/Vorbis audio can have loop points, which work in VVVVVV. Ved 1.10.0 added support for playing the audio with loop points correctly as well, but this relies on <a href="https://love2d.org/wiki/love.audio.newQueueableSource" target="_blank"><tt>QueueableSource</tt></a>, which was added in L&Ouml;VE 11.0. So on older versions, the audio instead just loops from start to finish (including the intro and the possibly otherwise inaccessible part beyond the end point).

<h2><a name="debugmode">Debug mode</a></h2>
<p>Debug mode is a special mode used to access certain features and information that can be useful for debugging and developing Ved. Enabling debug mode has the following effects:</p>
<ul>
	<li>You can jump to any state by pressing F12</li>
	<li>The window title bar displays the FPS, state number, window size, cursor position and L&Ouml;VE version number.</li>
	<li>Entities have tooltips with their properties</li>
	<li>You can access the lua_debug console by pressing Ctrl+PageUp. Make sure you do have a console attached, this blocks the entire Ved window until you type <tt>cont</tt> in the console. This shortcut is always available on a crash screen, by the way, even outside debug mode.</li>
	<li>You can limit the framerate to 60, 30 or 15 by pressing Ctrl+PageDown</li>
	<li>Entity IDs/table keys are shown in the raw entity properties dialog</li>
	<li><s>The hidden tileset creator can be accessed by pressing LCtrl+\ in the main editor (I'm pretty sure I've written an explanation of it somewhere, but I may document it here as well)</s> (removed in 1.8.3)</li>
	<li>Pressing LCtrl+' in the main editor will print all tileset and tilecol numbers to the console</li>
	<li>Pressing F11 will print all global variables to the console</li>
	<li>Holding / in the main editor would display <img src="entity.png"> instead of all entities, but that key now jumps to the script editor.</li>
	<li>A visual indicator is added that displays when text input is being taken.</li>
	<li>On the loading screen, you can add a fake level to the list of levels by pressing Shift+F2, and (visually) remove the last level from the list by pressing Shift+F3. This is for testing the scrolling area and such.</li>
	<li>You can see outlines for all GUI elements (see <a href="#guielements">below</a>) by holding F8</li>
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

<p>To <strong>get</strong> a tile in a room, use <?php hyperlight('roomdata_get(x, y, tx, ty)', 'generic', 'tt'); ?>. To get all of a room's tiles, use <?php hyperlight('roomdata_get(x, y)', 'generic', 'tt'); ?>.</p>
<p>To <strong>set</strong> a tile, use <?php hyperlight('roomdata_set(x, y, tx, ty, value)', 'generic', 'tt'); ?>. To set all of a room's tiles, use <?php hyperlight('roomdata_set(x, y, values)', 'generic', 'tt'); ?>.</p>

<p>From <a href="https://gitgud.io/Dav999/ved/-/commit/3cd21a86026fbc3842d0b82853883e475df30d8e" target="_blank">1.8.0-pre22</a> until <a href="https://gitgud.io/Dav999/ved/-/commit/7977e21ecd825b11c0bc9adbf38b9985e98c3853" target="_blank">1.9.0-pre05</a>, these functions had an altstate argument for VVVVVV-CE. See the <a href="#codechangelog">Changelog of breaking codebase changes</a> for 1.9.0 for more info.</p>

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
<tt>levelmetadata</tt> is the table containing room metadata, or, looking at the VVVVVV level format, each <tt>edLevelClass</tt> inside the <tt>levelMetaData</tt> tags. Since 1.7.1, this table is indexed by the room's X and Y coordinate separately: <tt>levelmetadata[roomy][roomx]</tt> (Before 1.7.1 this was one index from 1-400). Each element is structured as follows:
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

<p>To <strong>get</strong> a room's metadata, use <?php hyperlight('levelmetadata_get(x, y)', 'generic', 'tt'); ?>.</p>
<p>To <strong>set</strong> an attribute of metadata, use <?php hyperlight('levelmetadata_set(x, y, attribute, value)', 'generic', 'tt'); ?>. It's also possible to use <?php hyperlight('levelmetadata_set(x, y, attribute_table)', 'generic', 'tt'); ?> to replace the entire room's metadata table.</p>

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
<tr><td><tt>DB.ADVANCED</tt></td><td>11</td><td>Advanced</td></tr>
</table>
<p><tt>DB.LOAD</tt> was added in Ved 1.6.0. <tt>DB.ADVANCED</tt> was added in Ved 1.10.0.</p>
<p>There's also built-in lists of buttons available as <tt>DBS</tt>, like <tt>DBS.YESNO</tt>, which stands for <tt>{DB.YES, DB.NO}</tt>, meaning a Yes and No button.</p>
<table border="1">
<tr><th>Constant</th><th>Buttons</th></tr>
<tr><td><tt>DBS.OK</tt></td><td>OK</td></tr>
<tr><td><tt>DBS.QUIT</tt></td><td>Quit</td></tr>
<tr><td><tt>DBS.YESNO</tt></td><td>Yes, No</td></tr>
<tr><td><tt>DBS.OKCANCEL</tt></td><td>OK, Cancel</td></tr>
<tr><td><tt>DBS.OKCANCELAPPLY</tt></td><td>OK, Cancel, Apply</td></tr>
<tr><td><tt>DBS.OKCANCELADVANCED</tt></td><td>OK, Cancel, Advanced</td></tr>
<tr><td><tt>DBS.SAVEDISCARDCANCEL</tt></td><td>Save, Discard, Cancel</td></tr>
<tr><td><tt>DBS.YESNOCANCEL</tt></td><td>Yes, No, Cancel</td></tr>
<tr><td><tt>DBS.SAVECANCEL</tt></td><td>Save, Cancel</td></tr>
<tr><td><tt>DBS.LOADCANCEL</tt></td><td>Load, Cancel</td></tr>
</table>
<p><tt>DBS.SAVECANCEL</tt> and <tt>DBS.LOADCANCEL</tt> were added in Ved 1.6.0. <tt>DBS.OKCANCELADVANCED</tt> was added in Ved 1.10.0.</p>
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
Each dialog can have a list (a table) of input fields that will be shown in the dialog. Each input field is a table with sequential properties that always start with the following:
<ol>
	<li>Key (its identifier, like <tt>name</tt> in a HTML input field)</li>
	<li>X position in characters (blocks of 8)</li>
	<li>Y position in characters (blocks of 8)</li>
	<li>Width of input field in characters (so in blocks of 8 again)</li>
	<li>Default value (like <tt>value</tt> in HTML)</li>
	<li>Type (for example, use <tt>DF.TEXT</tt> for a text field)</li>
</ol>
<p>The X and Y positions for the field both start at 0, which is the position the regular dialog text also starts.<br>
These are the different types of input fields:</p>
<table border="1">
	<tr><td>0</td><td><tt>DF.TEXT</tt></td><td>Text input</td></tr>
	<tr><td>1</td><td><tt>DF.DROPDOWN</tt></td><td>Dropdown</td></tr>
	<tr><td>2</td><td><tt>DF.LABEL</tt></td><td>Plain text label (does not take input)</td></tr>
	<tr><td>3</td><td><tt>DF.CHECKBOX</tt></td><td>Checkbox</td></tr>
	<tr><td>4</td><td><tt>DF.RADIOS</tt></td><td>Radio button list</td></tr>
	<tr><td>5</td><td><tt>DF.FILES</tt></td><td>Files list and directory navigation</td></tr>
	<tr><td>6</td><td><tt>DF.HIDDEN</tt></td><td>Hidden field</td></tr>
</table>
<p>The <tt>DF.</tt> constants were added in Ved 1.5.0.</p>
<p><tt>dialog_uses.lua</tt> has some complete forms (but mostly functions that generate forms) under <tt>dialog.form</tt>. One general-purpose example is <tt>dialog.form.simplename</tt>, which has a single text field at position 0,1 to be used to fill in a name (for example a name for a new script or note), and <tt>dialog.form.simplename_make(default)</tt> to generate a similar form but with a value pre-filled.</p>
<p>More information about how the different types work:</p>
<h4>(0) DF.TEXT - Text input</h4>
A text field is what it says it is. An example is given as follows: <?php hyperlight('{"name", 0, 1, 40, "", DF.TEXT}', 'generic', 'tt'); ?><br>
Here, the key is <tt>name</tt>, it is positioned on the start of the second line of text, it is 40 characters wide (but more characters will fit) and its default value is an empty string.

<h4>(1) DF.DROPDOWN - Dropdown</h4>
Dropdowns require at least one more argument:
<ol start="7">
	<li>A list of items shown in the dropdown menu</li>
	<li>An optional table that converts a value to a displayable &quot;current selection&quot; if you want to hide how the value is passed. If not given, set this to <tt>false</tt> if you also want to supply the next argument.</li>
	<li>An optional function that gets called whenever a selection is made from the dropdown. Think of an <tt>onchange</tt> event in HTML/JS. Gets passed the selection from the dropdown as text, and may return a substitute to fill into the input field behind the scenes.</li>
</ol>
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
{"option", 0, 5, 2+font8:getWidth(OPTIONLABEL)/8, true, DF.CHECKBOX},
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
<ol start="7">
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

<h4>(6) DF.HIDDEN - Hidden field</h4>
<p>Hidden fields were added in Ved 1.8.5. A hidden field can be used to carry data from dialog creation to dialog submission, without accepting user changes. For example, if you have a confirmation dialog to delete a certain script, you want to still know what script it was when the user presses &quot;Yes&quot;. The type of the value can be anything you need, as long as it is not <tt>nil</tt> (again, Lua limitation, unless we changed dialog fields to have string keys for named arguments). <tt>nil</tt> values could instead be encoded as having the field be missing altogether, which will have the same effect, because for the handler, <tt>fields.the_missing_field</tt> would yield <tt>nil</tt> anyway. Position and width has no meaning for this field, so for example: <?php hyperlight('{"key", 0, 0, 0, "value", DF.HIDDEN}', 'generic', 'tt'); ?></p>
<p>There is a convenience function to make a form with hidden fields from a table where the keys and values correspond to the field keys and values: <?php hyperlight('dialog.form.hidden_make(values, existing_form)', 'generic', 'tt'); ?>. <tt>existing_form</tt> can be filled in if you already have a form, and simply want to add one or more hidden fields to it.<br>
For example:<br>
<?php hyperlight('dialog.form.hidden_make({script="applebapple"})', 'generic', 'tt'); ?> or<br>
<?php hyperlight('dialog.form.hidden_make({script="applebapple"}, dialog.form.simplename)', 'generic', 'tt'); ?>
</p>

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

<h3><a name="hotkeyfunc">Hotkey check function</a></h3>
<p>The following function can be used in button UI elements, to easily add a functioning hotkey to a button. This function will return an anonymous function which returns true if the given hotkey, in combination with a modifier key if specified, is pressed.</p>
<dl>
<dt><?php hyperlight('hotkey(checkkey, checkmod)', 'generic', 'tt'); ?></dt>
<dd>
	<tt>checkkey</tt>: The <a href="https://love2d.org/wiki/KeyConstant" target="_blank">key constant</a> to check.<br>
	<tt>checkmod</tt>: Optional. If specified, the key constant to additionally check. <u>This is passed to <tt>keyboard_eitherIsDown</tt></u>, which means 'l' and 'r' variants are checked.
</dd>
</dl>

<h3>keyboard_eitherIsDown(...)</h3>
In order to avoid needing to use <?php hyperlight('love.keyboard.isDown("lshift", "rshift")', 'generic', 'tt'); ?> or even <?php hyperlight('love.keyboard.isDown("lshift") or love.keyboard.isDown("rshift")', 'generic', 'tt'); ?>, the function <tt>keyboard_eitherIsDown(...)</tt> exists. This works similarly to <tt>love.keyboard.isDown(...)</tt>, except for each key passed, it checks 'l' and 'r' variants of that key. It therefore only makes sense to use this with modifier keys that actually have (or may have) both left and right variants that are named as such. Example: <?php hyperlight('keyboard_eitherIsDown("shift")', 'generic', 'tt'); ?>

<h3>Hotkey codes</h3>
<p>Each symbol in the hotkey font, <tt>tinynumbersfont</tt>, is actually mapped to one specific character, and is case-sensitive.</p>
<p>What this means is that, for example, <tt>a</tt> is Alt, but <tt>A</tt> is just the letter A. In fact, <tt>0</tt>-<tt>9</tt> and <tt>A</tt>-<tt>Z</tt> (uppercase) are all just themselves, along with a lot of other characters. You can also easily combine symbols togetter like so: <tt>aS</tt> would simply be Alt+S, and show up as such accordingly.</p>
<p>In the following list of usable symbols, a character is simply itself if it has no text saying otherwise:</p>
<ul>
	<li><tt>0</tt> through <tt>9</tt></li>
	<li><tt>A</tt> through <tt>Z</tt></li>
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

<h2><a name="guielements">GUI elements</a></h2>
TODO: Update this for 1.8.4, each state now has a folder, not a single file.<br><br>
Each <a href="#states">state</a> can have a list of elements in their file in <tt>uis/</tt>, which is a table <tt>ui.elements</tt>. Each of these elements at the root is drawn in order - all being given a position of 0,0 and remaining width and height as the window dimensions - and their callbacks are called when that state is active. The internal functioning of the different classes of UI elements can be found in <tt>ui_elements.lua</tt>. There are certain element <strong>classes</strong> such as <tt>elButton</tt> with all sorts of parameters controlling their behavior (for example, whether it's a button with text on it, or whether it's an icon), which actually implement the callbacks (documenting which is TODO). Then there are easy <strong>constructor functions</strong> which actually create and &quot;configure&quot; these classes depending on what you want (for example, a <tt>LabelButton</tt> constructor has an argument for the text to display on the button, which an <tt>ImageButton</tt> doesn't need because it has arguments to do with displaying a clickable image). The following constructors for UI elements exist:

<dl>
<dt><?php hyperlight('DrawingFunction(func)', 'generic', 'tt'); ?></dt>
<dd>
	This element simply calls a drawing function <tt>func(x, y, maxw, maxh)</tt>. This function may return its actual width and height, and must do so if it's in a container that expects width and height.
</dd>
<dt><?php hyperlight('FloatContainer(el, fx, fy, maxw, maxh)', 'generic', 'tt'); ?></dt>
<dd>
	Container that puts a sub-element at completely custom coordinates.
</dd>
<dt><?php hyperlight('AlignContainer(el, calign, cvalign)', 'generic', 'tt'); ?></dt>
<dd>
	Aligns its sub-element left/center/right and top/center/bottom depending on parent <tt>maxw</tt> and <tt>maxh</tt>.<br>
	<tt>calign</tt>: One of <tt>ALIGN.LEFT</tt>, <tt>ALIGN.CENTER</tt> or <tt>ALIGN.RIGHT</tt><br>
	<tt>cvalign</tt>: One of <tt>VALIGN.TOP</tt>, <tt>VALIGN.CENTER</tt> or <tt>VALIGN.BOTTOM</tt>
</dd>
<dt><?php hyperlight('ScreenContainer(els, cw, ch)', 'generic', 'tt'); ?></dt>
<dd>
	Simply holds more elements as though this is another root.<br>
	<tt>cw</tt> / <tt>ch</tt>: container width and height. <tt>nil</tt> to fill the remaining parent width/height.
</dd>
<dt><?php hyperlight('ListContainer(els_top, els_bot, cw, ch, align, starty, spacing, starty_bot, spacing_bot)', 'generic', 'tt'); ?></dt>
<dd>
	Vertical list container.
	Elements from the top are displayed at <tt>starty</tt>, elements from the bottom are <tt>starty_bot</tt> pixels away from <tt>maxh</tt> given in the draw function.
	If the <tt>maxh</tt> given to the draw function is infinite (<tt>nil</tt>), then bottom elements are not shown.<br>
	<tt>cw</tt> / <tt>ch</tt>: container width and height. <tt>nil</tt> to fill the remaining parent width/height.<br>
	<tt>align</tt>: the horizontal alignment of the elements. Can be <tt>ALIGN.LEFT</tt>, <tt>ALIGN.CENTER</tt> or <tt>ALIGN.RIGHT</tt>. Centered by default. This argument was added in Ved 1.8.5.<br>
	<tt>spacing</tt>: the spacing between each top element<br>
	<tt>starty_bot</tt>: if not given, this defaults to <tt>starty</tt>.<br>
	<tt>spacing_bot</tt>: if not given, this defaults to <tt>spacing</tt>.
</dd>
<dt><?php hyperlight('HorizontalListContainer(els_left, els_right, cw, ch, align, startx, spacing, startx_right, spacing_right)', 'generic', 'tt'); ?></dt>
<dd>
	Horizontal list container. Works the same as a vertical list container, but &quot;top&quot; and &quot;bottom&quot; correspond to &quot;left&quot; and &quot;right&quot;, and <tt>align</tt> is the vertical alignment of the elements (can be <tt>VALIGN.TOP</tt>, <tt>VALIGN.CENTER</tt> or <tt>VALIGN.BOTTOM</tt>)
</dd>
<dt><?php hyperlight('RightBar(els_top, els_bot)', 'generic', 'tt'); ?></dt>
<dd>
	A right-aligned vertical list container with a width of 128, and <tt>starty</tt> and <tt>spacing</tt> of 8.
</dd>
<dt><?php hyperlight('Spacer(w, h)', 'generic', 'tt'); ?></dt>
<dd>
	Filler element that just takes space.
</dd>
<dt><?php hyperlight('LabelButtonSpacer()', 'generic', 'tt'); ?></dt>
<dd>
	Filler element the size of a LabelButton.
</dd>
<dt><?php hyperlight('LabelButton(label, action, hotkey_text, hotkey_func, status_func, action_r, hotkey_r_func)', 'generic', 'tt'); ?></dt>
<dd>
	A clickable button with a text label. If clicked or the hotkey is used, the function <tt>action</tt> is run.<br>
	<tt>hotkey_text</tt>: The displayed hotkey when holding F9. Displayed in the tiny numbers font.<br>
	<tt>hotkey_func</tt>: A function that takes a key as argument (from <tt>love.keypressed(key)</tt>) and returns true if this button's hotkey is pressed (so that <tt>action</tt> will run). There is a convenience function <?php hyperlight('hotkey(checkkey, checkmod)', 'generic', 'tt'); ?>. For more about that, see <a href="#hotkeyfunc">the section</a> about it above. Example: <?php hyperlight('hotkey("escape")', 'generic', 'tt'); ?><br>
	<tt>status_func</tt>: A function that can have three return values indicating the button's status: <tt>shown</tt>, <tt>enabled</tt>, <tt>yellow</tt>. If nil, <tt>shown</tt> and <tt>enabled</tt> default to true, <tt>yellow</tt> defaults to false.<br>
	<tt>action_r</tt>: A function to run when the button is right-clicked.<br>
	<tt>hotkey_r_func</tt>: Similar to <tt>hotkey_func</tt>, but returns true if the hotkey is pressed for executing the &quot;right-click&quot; action.
</dd>
<dt><?php hyperlight('ImageButton(image, scale, action, hotkey_text, hotkey_func, status_func, action_r, hotkey_r_func)', 'generic', 'tt'); ?></dt>
<dd>
	A clickable image (scaled <tt>scale</tt> times) that will appear dimmed or normal depending on whether the cursor hovers over it. For argument descriptions, see LabelButton.
</dd>
<dt><?php hyperlight('InvisibleButton(w, h, action, hotkey_text, hotkey_func, status_func, action_r, hotkey_r_func)', 'generic', 'tt'); ?></dt>
<dd>
	A clickable button that is not displayed. For argument descriptions, see LabelButton.
</dd>
<dt><?php hyperlight('EditorIconBar()', 'generic', 'tt'); ?></dt>
<dd>
	A horizontal list container with image buttons for undo, redo, cut, copy and paste.
</dd>
<dt><?php hyperlight('Text(text, color_func, sx, sy)', 'generic', 'tt'); ?></dt>
<dd>
	This was added in Ved 1.8.5.<br>
	A text displayed via <tt>ved_print</tt>. <tt>text</tt> can be either a string, or a function returning a string. <tt>color_func</tt> may be a function that returns R, G, B, and optionally A values (0-255). <tt>sx</tt> and <tt>sy</tt> are horizontal and vertical scale values (default 1).<br>
	All arguments are optional except <tt>text</tt>.
</dd>
<dt><?php hyperlight('WrappedText(text, maxwidth, align, color_func, sx, sy)', 'generic', 'tt'); ?></dt>
<dd>
	This was added in Ved 1.8.5.<br>
	A text displayed via <tt>ved_printf</tt>. <tt>text</tt> can be either a string, or a function returning a string. If <tt>maxwidth</tt> is not given, the remaining parent width will be filled. <tt>align</tt> is passed to <tt>ved_printf</tt>/<tt>love.graphics.printf</tt>. <tt>color_func</tt> may be a function that returns R, G, B, and optionally A values (0-255). <tt>sx</tt> and <tt>sy</tt> are horizontal and vertical scale values (default 1).<br>
	All arguments are optional except <tt>text</tt>.
</dd>
</dl>

<h2><a name="codechangelog">Changelog of breaking codebase changes</a></h2>
<p>Ved 1.8.4 introduced some pretty major changes in the code, which probably broke a lot of plugins. I thought it might be a good idea to finally start documenting breaking &quot;API&quot; changes at this point, instead of having everyone figure them out as commits go by and new versions get released. So this log starts at 1.8.4 and is intended to give an overview of changes that are likely to break plugins.</p>
<p>Depending on how likely I think changes are to break plugins and depending on the weather<!--actually depending on my mood but I thought this was funnier-->, changes may or may not get listed here. I'll probably list a lot that isn't necessary, and on the other hand there will probably be some changes I didn't imagine would affect anyone but turn out they do (especially when plugins find-and-replace too large blocks of code or something).</p>
<p>Numbers at the start of list items indicate relevant pre-versions in which the changes were introduced.</p>
<dl>
<dt><strong>1.8.4</strong></dt>
<dd>
	<ul>
		<li>[01] <tt>main2.lua</tt> has been removed, now all L&Ouml;VE callbacks are in appropriately-named <tt>callback_*.lua</tt> files.</li>
		<li>[03] UI code (in <tt>uis/</tt>) is now no longer one file per UI, but one folder per UI. <tt>ui.load()</tt>, <tt>ui.elements</tt>, et cetera are now in dedicated files that return those callbacks/the elements table: <tt>uis/NAME/load.lua</tt>, <tt>uis/NAME/elements.lua</tt>, ...</li>
		<li>[03] <tt>drawhelp.lua</tt> &rarr; <tt>uis/help/draw.lua</tt></li>
		<li>[03] <tt>drawlevelslist.lua</tt> &rarr; <tt>uis/levelslist/draw.lua</tt></li>
		<li>[03] <tt>drawmaineditor.lua</tt> &rarr; <tt>uis/maineditor/draw.lua</tt></li>
		<li>[03] <tt>drawmap.lua</tt> &rarr; <tt>uis/map/draw.lua</tt></li>
		<li>[03] <tt>drawscripteditor.lua</tt> &rarr; <tt>uis/scripteditor/draw.lua</tt></li>
		<li>[03] <tt>drawsearch.lua</tt> &rarr; <tt>uis/search/draw.lua</tt></li>
		<li>[13] Most <tt>Image</tt> objects created in <tt>love.load()</tt> are now prefixed <tt>image.</tt> (like <tt>image.undobtn</tt> instead of <tt>undobtn</tt>).<br>
			Some were also renamed: [<tt>un</tt>]<tt>selectedtoolborder</tt> &rarr; <tt>image.</tt>[<tt>un</tt>]<tt>selectedtool</tt>, <tt>solid</tt>[<tt>half</tt>]<tt>img</tt> &rarr; <tt>image.solid</tt>[<tt>half</tt>].<br>
			<tt>platformimg</tt> and <tt>platformpart</tt> were removed, these were used in Vis
		</li>
	</ul>
</dd>
<dt><strong>1.8.5</strong></dt>
<dd>
	<ul>
		<li>[01] Some random identifiers were changed from justconcatenatedtogethercase to snake_case, but probably not extensively-used ones (like <tt>uniquenotename</tt> &rarr; <tt>unique_note_name</tt> or <tt>getalllanguages</tt> &rarr; <tt>get_all_languages</tt>)</li>
		<li>[03] <tt>ListContainer</tt> and <tt>HorizontalListContainer</tt> elements now have an <tt>align</tt> argument added after <tt>ch</tt>. Before this, elements in list containers were always horizontally/vertically centered, now this is just the default.<br>
			Old vs new signatures:<br>
			<?php hyperlight('ListContainer(els_top, els_bot, cw, ch, starty, spacing, starty_bot, spacing_bot)', 'generic', 'tt'); ?> (old)<br>
			<?php hyperlight('ListContainer(els_top, els_bot, cw, ch, align, starty, spacing, starty_bot, spacing_bot)', 'generic', 'tt'); ?> (new)<span class="br_bigger"></span>
			<?php hyperlight('HorizontalListContainer(els_left, els_right, cw, ch, startx, spacing, startx_right, spacing_right)', 'generic', 'tt'); ?> (old)<br>
			<?php hyperlight('HorizontalListContainer(els_left, els_right, cw, ch, align, startx, spacing, startx_right, spacing_right)', 'generic', 'tt'); ?> (new)<span class="br_bigger"></span>
		</li>
		<li>[05] Using <tt>input</tt> to carry state in dialogs is now strongly discouraged in favor of <tt>DF.HIDDEN</tt> fields (with <tt>dialog.form.hidden_make(...)</tt>)</li>
		<li>[05] All instances of <tt>rvnum</tt> have been replaced by <tt>script_i</tt> (or in the help system, <tt>article_i</tt></li>
		<li>[08] The help system no longer reserves the first article for the Return button, and the formatting code <tt>)</tt> has been removed</li>
	</ul>
</dd>
<dt><strong>1.9.0</strong></dt>
<dd>
	<ul>
		<li>VVVVVV-CE support has been removed, so any functions accepting arguments like altstate, custom graphics sets, etc will lack that argument:<br>
			[02]<br>
			<?php hyperlight('tileset_image(themetadata, chosentileset, customtileset)', 'generic', 'tt'); ?> (old)<br>
			<?php hyperlight('tileset_image(themetadata, chosentileset)', 'generic', 'tt'); ?> (new)<span class="br_bigger"></span>
			[04]<br>
			<?php hyperlight('drawentitysprite(tile, atx, aty, customspritesheet, small)', 'generic', 'tt'); ?> (old)<br>
			<?php hyperlight('drawentitysprite(tile, atx, aty, small)', 'generic', 'tt'); ?> (new)<span class="br_bigger"></span>
			<?php hyperlight('displaysmalltilespicker(offsetx, offsety, chosentileset, chosencolor, customtileset, scale)', 'generic', 'tt'); ?> (old)<br>
			<?php hyperlight('displaysmalltilespicker(offsetx, offsety, chosentileset, chosencolor, scale)', 'generic', 'tt'); ?> (new)<span class="br_bigger"></span>
			<?php hyperlight('insert_entity_full(rx, ry, astate, intower, subx, suby, atx, aty, t, p1, p2, p3, p4, data)', 'generic', 'tt'); ?> (old)<br>
			<?php hyperlight('insert_entity_full(rx, ry, atx, aty, t, p1, p2, p3, p4, data)', 'generic', 'tt'); ?> (new)<span class="br_bigger"></span>
			[05] focused on altstates, which were originally added in <a href="https://gitgud.io/Dav999/ved/-/commit/3cd21a86026fbc3842d0b82853883e475df30d8e" target="_blank">1.8.0-pre22</a> and <a href="https://gitgud.io/Dav999/ved/-/commit/855e0b6f822c188a5ff62e2509c129e5f97ec97f" target="_blank">1.8.0-pre23</a>. The altstate arguments were optional and defaulted to the main state if nil/not specified.<br>
			<?php hyperlight('displayentities(offsetx, offsety, myroomx, myroomy, altst, bottom2rowstext)', 'generic', 'tt'); ?> (old)<br>
			<?php hyperlight('displayentities(offsetx, offsety, myroomx, myroomy, bottom2rowstext)', 'generic', 'tt'); ?> (new)<span class="br_bigger"></span>
			<?php hyperlight('getroomcopydata(rx, ry, altst)', 'generic', 'tt'); ?> (old)<br>
			<?php hyperlight('getroomcopydata(rx, ry)', 'generic', 'tt'); ?> (new)<span class="br_bigger"></span>
			<?php hyperlight('setroomfromcopy(data, rx, ry, altst, skip_undo)', 'generic', 'tt'); ?> (old)<br>
			<?php hyperlight('setroomfromcopy(data, rx, ry, skip_undo)', 'generic', 'tt'); ?> (new)<span class="br_bigger"></span>
			<?php hyperlight('rotateroom180(rx, ry, altst, undoing)', 'generic', 'tt'); ?> (old)<br>
			<?php hyperlight('rotateroom180(rx, ry, undoing)', 'generic', 'tt'); ?> (new)<span class="br_bigger"></span>
			<?php hyperlight('gotoroom(rx, ry, altst)', 'generic', 'tt'); ?> (old)<br>
			<?php hyperlight('gotoroom(rx, ry)', 'generic', 'tt'); ?> (new)<span class="br_bigger"></span>
			<?php hyperlight('roomdata_get(rx, ry, altst, tx, ty, uselevel2)', 'generic', 'tt'); ?> (old)<br>
			<?php hyperlight('roomdata_get(rx, ry, tx, ty, uselevel2)', 'generic', 'tt'); ?> (new)<span class="br_bigger"></span>
			<?php hyperlight('roomdata_set(rx, ry, altst, tx, ty, value)', 'generic', 'tt'); ?> (old)<br>
			<?php hyperlight('roomdata_set(rx, ry, tx, ty, value)', 'generic', 'tt'); ?> (new)<span class="br_bigger"></span>
			<?php hyperlight('roomdata_set(rx, ry, altst, values)', 'generic', 'tt'); ?> (old)<br>
			<?php hyperlight('roomdata_set(rx, ry, values)', 'generic', 'tt'); ?> (new)<span class="br_bigger"></span>
		</li>
		<li>[05] <tt>next_key(t, c)</tt> was removed, but I'm willing to bet no plugin was using it. (&quot;Return the lowest key in table t that is higher than c. If not found, return nil.&quot;)</li>
		<li>[19] <tt>hoverrectangle(...)</tt> now returns whether the rectangle was hovered over, for convenience</li>
		<li>[19] Due to the script editor switching to the new input system, <tt>scriptlines</tt> and <tt>editingline</tt> are now no longer used. Instead, <tt>inputs.script_lines</tt> is the input, and when it's not appropriate to edit that directly, a copy of the table is made instead.<br><tt>processflaglabels()</tt> and <tt>processflaglabelsreverse()</tt> now both take the script as argument: <?php hyperlight('processflaglabels(raw_script)', 'generic', 'tt'); ?> and <?php hyperlight('processflaglabelsreverse(readable_script)', 'generic', 'tt'); ?>.<br><tt>processflaglabels</tt> now returns the &quot;human-readable&quot; script (<tt>readable_script</tt>).<br><tt>processflaglabelsreverse</tt> used to return true if it failed due to running out of flags to allocate, now it returns <tt>success</tt> as a first argument and the &quot;raw&quot;/&quot;VVVVVV-parser-readable&quot; script as the second argument (<tt>raw_script</tt>). <tt>success</tt> can be false if it ran out of flags, or splitting internal scripts failed.</li>
		<li>[20] In addition to the above, <tt>processflaglabels</tt> is now called <tt>script_decompile</tt>, and <tt>processflaglabelsreverse</tt> is now called <tt>script_compile</tt>.</tt>
		<li>[27] Tilesets have been refactored a little:<br>
			<tt>tilesets[file].tileswidth</tt> and <tt>tilesets[file].tilesheight</tt> have been snake_cased to <tt>.tiles_width</tt> and <tt>.tiles_height</tt>.<br>
			<tt>.total_tiles</tt> has been added. This is <tt>.tiles_width * .tiles_height</tt>.<br>
			<tt>.tiles_width_picker</tt> and <tt>.tiles_height_picker</tt> have been added to indicate what the dimensions should be in the tiles picker (only different from <tt>.tiles_width</tt> and <tt>.tiles_height</tt> if <tt>.tiles_width</tt> is higher than 40.)<br>
			Note that <tt>.total_tiles</tt> may be less than <tt>.tiles_width_picker * .tiles_height_picker</tt>.
		</li>
		<li>[27] The <tt>tilesetnames</tt> table has been replaced by <tt>tileset_names</tt> and now works differently. <tt>tilesetnames</tt> mapped from tileset <strong>file</strong> number 1, 2 or 3 to the filename of that tileset file. It was never used without the <tt>usedtilesets</tt> table, which maps from chooseable tileset numbers (Space Station, Outside, ... being 0, 1, ...) to tileset file number 1, 2 or 3. <tt>tileset_names</tt> now maps directly from chooseable tileset number to the corresponding filename. Thus, the hellish <?php hyperlight('tilesets[tilesetnames[usedtilesets[selectedtileset]]]', 'generic', 'tt'); ?> can be written a little shorter as <?php hyperlight('tilesets[tileset_names[selectedtileset]]', 'generic', 'tt'); ?>.</li>
		<li>[38] Various names of tables and functions have been snake_cased:<br>
			<tt>listmusicnamesids</tt> &rarr; <tt>list_music_names_ids</tt><br>
			<tt>listmusicnames</tt> &rarr; <tt>list_music_names</tt><br>
			<tt>listmusicids</tt> &rarr; <tt>list_music_ids</tt><br>
			<tt>listmusiccommandsnamesids</tt> &rarr; <tt>list_music_commands_names_ids</tt><br>
			<tt>listmusiccommandsids</tt> &rarr; <tt>list_music_commands_ids</tt><br>
			<tt>musicsimplifiedtointernal</tt> &rarr; <tt>music_simplified_to_internal</tt><br>
			<tt>listsoundids</tt> &rarr; <tt>list_sound_ids</tt><br>
			<tt>returnusedflags(...)</tt> &rarr; <tt>return_used_flags(...)</tt><br>
			<tt>syntaxhl(...)</tt> &rarr; <tt>syntax_hl(...)</tt><br>
			<tt>justtext(...)</tt> &rarr; <tt>just_text(...)</tt><br>
			<tt>scriptcontext(...)</tt> &rarr; <tt>script_context(...)</tt><br>
			<tt>findscriptreferences(...)</tt> &rarr; <tt>find_script_references(...)</tt><br>
			<tt>findusedscripts(...)</tt> &rarr; <tt>find_used_scripts(...)</tt><br>
		</li>
		<li>[39] The big block of code at the top of <tt>uis/maineditor/draw.lia</tt> that handled using the mouse buttons in the main editor (so, all the tools) has been moved to its own file and function, <tt>handle_tool_mousedown()</tt> in <tt>tool_mousedown.lua</tt>.</li>
		<li>[39] Entity right-clicking/(shift+)alt+clicking (so, including creating right click menus for entities) has been taken out of entity drawing code (<tt>displayentities(...)</tt> and <tt>displayentity(...)</tt>) and moved to its own file and function, <tt>handle_entity_mousedown()</tt> in <tt>entity_mousedown.lua</tt>.</li>
		<li>[39] <tt>entityrightclick(x, y, menuitems, newmenuid[, sel_w, sel_h[, sel_x, sel_y]])</tt> has been split into <tt>entity_highlight(x, y[, sel_w, sel_h[, sel_x, sel_y]])</tt> (for the visual entity border) and <tt>entity_interactable(k, x, y, menuitems, newmenuid)</tt> (for the right click menus in <tt>handle_entity_mousedown()</tt>.</li>
		<li>[46] Fixed plugin code changes being double-escaped on changing language/font (not a breaking change but may be good to know anyway</li>
		<li>[50] .vvv metadata in the music table is now <tt>.vvv_metadata</tt> instead of <tt>.meta</tt>. Some music player functions were renamed:<br>
			<tt>getmusicmeta_file</tt> &rarr; <tt>music_get_file_vvv_metadata</tt><br>
			<tt>setmusicmeta_file</tt> &rarr; <tt>music_set_file_vvv_metadata</tt><br>
			<tt>getmusicmeta_song</tt> &rarr; <tt>music_get_song_vvv_metadata</tt><br>
			<tt>setmusicmeta_song</tt> &rarr; <tt>music_get_song_vvv_metadata</tt><br>
			<tt>getmusicfiledata</tt> &rarr; <tt>music_get_filedata</tt><br>
			<tt>getmusicaudio</tt> &rarr; <tt>music_get_audio</tt><br>
			<tt>getmusicaudioplaying</tt> &rarr; <tt>music_get_audio_playing</tt><br>
			<tt>getmusicedited</tt> &rarr; <tt>music_get_edited</tt><br>
		</li>
	</ul>
</dd>
<dt><strong>1.10.0 (was 1.9.2)</strong></dt>
<dd>
	<ul>
		<li>[13] Instead of using any code containing the string <tt>/available_libs/</tt>, <tt>prepare_library</tt> and <tt>load_library</tt> from <tt>librarian.lua</tt> are now preferred.</li>
		<li>[13] The order of initializations in <tt>love.load()</tt> has been changed a little bit.</li>
		<li>[24] The function <tt>directory_exists(where, what)</tt> has been changed into <tt>directory_exists(path)</tt>. Use <tt>directory_exists(where .. dirsep .. what)</tt> if you need to.</li>
		<li>[28] Regardless of L&Ouml;VE version, <tt>love.mousepressed</tt> now never uses <tt>&quot;wu&quot;</tt> or <tt>&quot;wd&quot;</tt> constants, and <tt>love.wheelmoved</tt> is now always used instead. So instead of, on L&Ouml;VE 0.10+, redirecting <tt>love.wheelmoved</tt> to <tt>love.mousepressed</tt> with &quot;fake&quot; wu/wd buttons, we now, on L&Ouml;VE 0.9, redirect <tt>love.mousepressed</tt> with wu/wd buttons to <tt>love.wheelmoved</tt> with a &quot;fake&quot; 1/-1 y movement. The <tt>love_mousepressed_start</tt> hook has been changed accordingly, and a new hook <tt>love_wheelmoved_start</tt> has been added. This change applies to UIs' and elements' callbacks as well.</li>
	</ul>
</dl>

<h2><a name="eastereggs">Easter eggs</a></h2>
Ved contains several easter eggs.

<?php include('links.php'); ?>
</body>
</html>
