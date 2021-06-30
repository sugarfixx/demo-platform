# demo-platform

## Backend fro frontend
aggregate user (id + email)
aggregate tenant (id + name)
aggregate tenant Users (tenant_id + user_id)
aggregate content packages
aggregate content packages criteria
aggregate content
aggregate contentMetadata

## User service
only users
topic:user


## Tenant Service
aggregate user (id + email)
aggregate contentPackages (id + name)
tenant has many tenant user
tenant has many content packages
topic:tenantUsers
topic:contentPackageTakers

## Content Package
ContentPackage
hasMany Criteria
topic:contentPackage

## Content
Content
hasMany Metadata
topicContent
