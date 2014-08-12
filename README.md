# old-browser-alert

This is a simple notification when an old browser is detected. Currently only old Internet Explorer (prior to 8.0) and Firefox (prior to 1.3.6) versions are detected.

## Installation

In main application directory:
 
	maniple module-install /path/to/old-browser-alert

## Usage

Make sure the bootstrap class of a module has `'old-browser-alert'` added to `_moduleDeps` property, to avoid any "view helper not found" exceptions.

In view scripts (typically in layouts) before HEAD tag insert:

	{% do oldBrowserAlert().appendStyle() %}

and at the beginning of the BODY tag insert: 

	{% oldBrowserAlert() %}

Whenever an old browser is detected alert is rendered in the view script, otherwise nothing happens. 

