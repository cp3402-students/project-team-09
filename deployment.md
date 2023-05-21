# Deployment to Microsoft Azure Web app

## Section 0: Our project management structure

We used Trello to manage and distribute tasks between developers that use a mix of MAMP stacks, VVV virtual machines and
other solutions to develop websites locally.

We used Github to collaborate and share our code. Github is also used as
part of our deployment workflow, as follows...

## Section 1: Staging deployment

Theme code contained in wp-content/themes/tsvcountrymusic is versioned in git, and shared
via https://github.com/cp3402-students/project-team-09

Theme code can be deployed to the webapp via a github action that prepares the theme code and transports it to the MS
Azure site folder at:

`/home/site/wwwroot/wp-content/themes/tsvcountrymusic`

This action is triggered whenever a push to the `staging` branch is made.
See `.github/workflows/staging_tsvcountrymusic_deploy.yml`

See the wordmove section for deployment of CMS database information.

## Section 2: Production deployment

A separate process is used for deploying to production. [Wordmove](https://github.com/welaika/wordmove) is the tool used
for this.

Wordmove can connect to MS Azure Webapps over SSH, but plain naked ssh connections are not supported - Users must
authenticate with the appropriate Microsoft Azure account to open connections to the instance. This is handled using the
Azure CLI
utility:

`az login` (Prompts for MS Account authentication)

SSH connections can be made via an authenticated tunnel:

```
az webapp create-remote-connection --subscription <subcription-id> --resource-group <resource-group-name> -n <resource-name> -p <port number>
```

...and hooked up to wordmove via this code in the movefile:

```
prod:
  vhost: <vhost>
  wordpress_path: /home/site/wwwroot

  database:
    name: dbname
    user: <user>
    password: <pw>
    host: <host>
  ssh:
    host: "127.0.0.1"
    port: <port-number>
    user: "root"
    password: "Docker!"
```

A similar entry is used to connect to the staging environment.

The ssh password is hardcoded by the Azure CLI utility, and only available locally, so is not strictly sensitive.

The database details for the movefile can be obtained from the configuration menu of the Azure Web
app resource.

## Installing modules on hosts

MYSQL and scp, among other things, must be available in MS Azure staging and production environments for wordmove
compatibility.

01/05/2023:

Azure web app service does not come with a version of openssh that allows SCP to work by default, manual workaround:

```
# scp
scp: not found
```

Reconfigure the host's installation of openssh:

```
/* (MS Azure Web app config as at 01/05/2023) */
# cat /etc/os-release
NAME="Alpine Linux"
ID=alpine
VERSION_ID=3.16.5
...

# apk add openssh
ERROR: unable to select packages:
  openssh-keygen-9.0_p1-r2:
    breaks: openssh-client-default-9.0_p1-r3[openssh-keygen=9.0_p1-r3]
    satisfies: openssh-server-9.0_p1-r2[openssh-keygen=9.0_p1-r2]
// Manually install openssh-keygen
# wget http://dl-cdn.alpinelinux.org/alpine/v3.16/main/x86_64/openssh-keygen-9.0_p1-r3.apk

# apk add --allow-untrusted openssh-keygen-9.0_p1-r3.apk
// openssh installation can proceed
# apk add openssh
# scp
usage: scp ...
```

Install mysql

```
# apk add mysql
# apk add mysql-client
```

Once complete, code and assets can be pushed back and forth using some permutation of:

`wordmove pull -e staging -tupd`
`wordmove push -e prod -tupd`

with whatever switches (theme, uploads, plugins, database, etc) as needed.



