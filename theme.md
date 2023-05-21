# For Theme maintainers:

This file contains information for future developers of this theme

## Design

This theme uses a colour scheme focusing on Lively shades of orange for a bright exciting mood. Dark coloured text in
blacks and browns are used for site text.

## Features

### Event and Magazine posts

Event and magazine posts are listed programmatically by code in the `post-lister.php` page template file. It displays
the event
title, a featured image if one is set, the excerpt if one is assigned, or a trimmed description if there isn't an
excerpt assigned.

Code that controls the output of the frontend Ninjaform event adding form is located in `nf-event-form.php`. Edit this
if it
is necessary to extend the functionality of the form, such as allowing image uploading or changing how the Event post
content resulting from a frontend form submission is generated.

SCSS is used for all styling. See underscores documentation for folder structure and more information.

### Navbar

The navbar is a mostly standard issue wordpress navbar menu that's been styled a lot
in `sass/components/navigation/_navigation.scss`

### Footer

A footer widget is used to provide a site admin an easy way to update content in the footer, such as content details or
sponsor relationship links.  


