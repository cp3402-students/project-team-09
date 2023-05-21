# For TTCMA website maintainers:

## Managing membership applications:

Membership applications are handled with the Ninja Forms WordPress plugin.

Website visitors that fill out the membership form at `/membership-application/` have their details sent to the
wordpress admin accounts' email address for consideration. They are also saved in the wp-admin UI under Admin ->
Ninja Forms -> Submissions.

## Creating new event posts:

Events are organised as WordPress posts.

Events can be managed in the WordPress posts UI in Admin -> Posts -> All Posts.

New Events can be created in the New Post UI and added to the events category by setting the category of a new post to "
event".

When possible, a "Featured image" and an "Excerpt" should be set in the UI for the purpose of presenting a preview when
events are viewed as a summarised list

Additionally, New Events can be added in the frontend, at `/new-event`. This area of the site is only accessible when
logged in as a wordpress administrator.

## Creating new magazine posts:

Magazines are organised as WordPress posts.

Magazines can be managed in the WordPress posts UI in Admin -> Posts -> All Posts.

New Magazine issues can be created in the New Post UI and added to the magazine category by setting the category of a
new post to "magazine".

## Receiving membership applications:

Applications are handled with a form build with the Ninjaforms plugin. It is set up to send form data from applications
to wordpress administrator emails on submission. Submissions are also recorded in raw form under:

`WP Dashboard -> Ninja forms -> Submissions.`

## Other

A footer widget, visible in the admin UI under Theme -> Widgets is used to provide a way for the site maintainer to
easily update contact details and other miscellaneous info that is kept in the footer.

The Envira plugin is used to display a photo gallery.

