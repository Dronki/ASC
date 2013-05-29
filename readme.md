Alpha SCP Converter
===================

A XML to SCP converter for DeathJockey's [Alpah-Scene-Animator](https://github.com/DeathJockey/Alpha-Scene-Animator)

Still working out most of the bugs in the code, as well as refining some regex.  
I'm trying to keep this up-to speed with SCP's doc that DeathJockey provides via his repo.

Working commands
----------------
<pre lang="xml"><code>
<scene action="set" value="cliff" />
<scene action="add" key="entity" value="bulbasaur" />
<scene action="moveto" key="entity" value="bulbasaur" x="21" y="21" />

<graphics action="effect" key="startle" value="bulbasur" /> Also returns a set-word, will do for now.
<graphics action="overlay" key="alpha" value="0.2" />
<graphics action="overlay" key="color" value="0,0,0" />
<graphics toggle="overlay" value="on" />

<audio action="play" file="tune.ogg" options="loop" />
<audio toggle="volume" value="50" />
<audio action="load" value="load.ogg" />

<dialog title="???" duration="1000">Hi, I'm a regex</dialog>

<dialog3p duration="1000">Hi, I'm a regex</dialog3p>
<dialog3p action="clear" />

<camera action="track" value="bulbasaur" />

<wait value="1000" />

<end type="terminate" />
</code><pre>
Non-working commands
--------------------
<pre lang="xml"><code>
<dialog action="clear" /> Doesn't seem to work, working on it.
</code></pre>