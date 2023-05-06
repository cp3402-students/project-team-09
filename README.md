This is the theme code for team-09's CP3402-2023 project.  
It is based on the underscores theme.

Documentation:

https://github.com/cp3402-students/project-team-09/blob/main/site.md

https://github.com/cp3402-students/project-team-09/blob/main/deployment.md

https://github.com/cp3402-students/project-team-09/blob/main/theme.md

To set up locally:

Navigate to your Wordpress installation, that's the folder with
wp-includes, wp-content, wp-admin

Go into `wp-content/themes`

Create a folder named tsvcountrymusic

Using any git command prompt tool (gitforwindows.org),

Make sure you go to the right folder:

`cd wp-content/themes/tsvcountrymusic`

`git clone https://github.com/cp3402-students/project-team-09.git`

Verify your folder structure looks like this:

```
wp-content/
  themes/
    tsvcountrymusic/
      .github/
      inc/
      js/
      languages/
      sass/
      template-parts/
      ...(other files)
```

If you want to develop a new feature:

`git checkout -b newfeature`

Make changes to theme files like style.css, add those files to one or more commits with `git add` then `git commit`

Pull any changes from main that have been made since you last pulled:

`git checkout main` `git pull origin main`

Then merge:

`git merge newfeature`

If there are no conflicts, you can push your merged feature to github:

`git push origin main` or `git push origin --all` if you want your feature branch recorded in the github repo.
