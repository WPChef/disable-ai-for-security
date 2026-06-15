=== Disable AI for Security ===
Contributors: wpchefgadget, nikitaglobal
Tags: ai, disable ai, security, connectors, privacy
Requires at least: 7.0
Tested up to: 7.0
Stable tag: 1.3.0
Requires PHP: 7.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Turns off the WordPress AI connectors for security. Works instantly with no settings — AI is fully disabled for every user role.

== Description ==

**Disable AI for Security** switches off the AI features introduced in WordPress 7.0 — quickly, cleanly, and without a single setting to configure.

WordPress 7.0 introduces built-in AI connectors. They're a great addition, but not every site needs them. If you prefer to keep your site lean and predictable, or your organization's policy is to keep AI features off, this plugin gives you a simple one-click way to do exactly that.

Just activate it. That's it. There is no settings page, no configuration, and nothing to maintain — the plugin starts protecting your site the moment it's enabled.

= What it does =

* **Disables WordPress AI at the core level.** Core stops registering AI providers, rejects AI connectors, and won't run AI prompts.
* **Works for every role.** AI is turned off site-wide — for administrators, editors, authors, and everyone else. No exceptions, no per-user toggles.
* **Hides the AI admin screens.** The Connectors and AI settings pages are removed from wp-admin, and direct links to them are blocked.
* **Shows a clear status badge.** A small green "AI Disabled" badge in the admin bar confirms protection is active.

= Why you'll like it =

* **Zero configuration.** No setup, no options, no learning curve.
* **Works out of the box.** Protection is on the instant you activate.
* **Lightweight and focused.** It does one job and does it well.

Brought to you by the team behind **Limit Login Attempts Reloaded**.

== Installation ==

1. Upload the `disable-ai-for-security` folder to the `/wp-content/plugins/` directory, or install the plugin through the **Plugins → Add New** screen in WordPress.
2. Activate the plugin through the **Plugins** menu.
3. Done. AI is now disabled site-wide — there's nothing else to configure.

== Frequently Asked Questions ==

= Do I need to configure anything? =

No. The plugin works the moment you activate it. There is no settings page.

= Does it disable AI for all users? =

Yes. AI is turned off site-wide for every role, including administrators.

= Will it slow down my site? =

No. The plugin is tiny and only adds a core filter plus a small admin-area style.

= How do I turn AI back on? =

Simply deactivate the plugin. WordPress AI features return to their default state.

= Which WordPress version is required? =

WordPress 7.0 or later, where the AI connectors were introduced.

== Changelog ==

= 1.3.0 =
* Disable WordPress 7.0 AI connectors via the `wp_supports_ai` filter.
* Remove AI / Connectors screens from wp-admin and block direct access.
* Add an "AI Disabled" status badge to the admin bar.
