# Characters

## firstname
varchar(50) | not null
## lastname
varchar(50) | not null
## jobs
ForeignKey | not null
## car
ForeignKey | null
## age
smallInt | not null

# Jobs

## name
varchar(50) | not null | unique

# Cars

## name
varchar(50) | not null | unique
## realease_date
date | not null