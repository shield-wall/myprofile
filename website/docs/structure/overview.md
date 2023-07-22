---
sidebar_position: 1
---

# Overview

Myprofile has the data organized in **columns**, And you can order, remove or duplicate **blocks** into the columns.

:::caution Minium amount of columns.

You most have at last **2 columns** in your resume, otherwise the resume layout could be weird 

:::

![This image describe how to use block and columns.](img/resume-explain.png)

#### Colums

In the [resume above 👆](#overview) you can see **two red** squares, Those squares mean **column**, 
and it can contain different **blocks** that can contain: `list`, `tag(s)`, `timeline` or just a simple `block` 

### Resume example

The markdown bellow will generate the pdf above 👆! just create a [new discussion](https://github.com/shield-wall/myprofile/discussions/new?category=resume) and copy and past into the description and wait the pipeline finish.

```markdown
{% column %}

{% block .basic %}
![Profile Picture](https://user-images.githubusercontent.com/6358755/229285256-03f05195-33b1-477f-ac5a-155a6a26a8c5.png) {% #profile-image %}

# John Doe

## Senior PHP Developer

{% /block %}

{% block .has-list %}
- [linkedin.com/**john-doe**](https://www.linkedin.com/in/eerison) {% .icon-linkedin %}
- Berlin, Germany {% .icon-location %}
- [hey@john.doe](mailto:hey@john-doe.com) {% .icon-mail %}
- [github.com/**john-doe**](https://your-link.com) {% .icon-github %}
- [blog.john-doe.com](https:blog.erison.work) {% .icon-website %}
{% /block%}

{% block .has-tag .has-skill %}

## Skills {% .icon-rock %}

- Symfony {% .icon-symfony %}
- PHP {% .icon-php %}
- Test {% .icon-double-check %}
- Git {% .icon-git-branch %}
- Docker {% .icon-docker %}
- Open source {% .icon-heart %}

{% /block %}

{% block %}

## Courses & Certifications {% .icon-certification %}

> ![Certification Logo 1](https://github.com/shield-wall/myprofile/assets/6358755/a9b5f93b-4c2b-4479-98db-376260665ad5)
>> **Certification example 01**
>> *December 2019*

>
>> **Certification example 02**
>> *December 2020*
{% /block %}

{% block %}
## Education {% .icon-education %}

>**Bachelor of Computer Science**
>*University XYZ*
>*March 2014 - July 2017*
{% /block %}

{% block .has-tags %}
## Languages {% .icon-language %}

**English**
**Advanced**

**Deutsch**
**Beginnen**
{% /block %}

{% /column %}

{% column %}

{% block %}
## Summary {% .icon-file-description %}

I'm a **Senior PHP Developer** with **5 years of experience** in developing web applications. My expertise lies in **building scalable and efficient PHP-based solutions** using frameworks like Laravel and Symfony. I have a strong understanding of **object-oriented programming**, **database design**, and **RESTful API development**.

Throughout my career, I have successfully delivered high-quality projects by following best practices such as **clean code**, **test-driven development (TDD)**, and **continuous integration**. I'm passionate about staying updated with the latest technologies and enjoy tackling complex challenges.

{% /block %}

{% block .has-timeline %}
## Experience {% .icon-work %}

>>> [![Company logo 1](https://github.com/shield-wall/myprofile/assets/6358755/f9918622-d3ba-4ae9-abb4-fc184948779b)](https://www.google.com)
>>
>>> ### Senior Software Engineer
>>> #### Example Company
>>> ##### Since Jan 2023
>>
>>> Example Company is a leading software development firm specializing in cutting-edge technologies. As a Senior Software Engineer, I have been instrumental in designing and developing scalable and high-performance systems. I have worked on various projects, including the implementation of distributed systems and the integration of third-party APIs.
>>>
>>> Throughout my tenure, I have utilized modern technologies such as **Node.js**, **Docker**, and **Kubernetes** to ensure efficient deployment and scalability. Additionally, I have contributed to the team's success by conducting thorough code reviews, implementing best practices, and collaborating closely with cross-functional teams.

>>>
>>
>>> ### Software Developer
>>> #### ABC Corporation
>>> ##### May 2018 - Dec 2022
>>
>>> During my time at ABC Corporation, I gained valuable experience in technologies such as **JavaScript**, **React**, and **Node.js**. I actively participated in code reviews, agile development processes, and continuous integration to deliver high-quality software products on time.

{% /block %}

{% block %}

## Courses & Certifications {% .icon-certification %}

> ![Certification Logo 1](https://github.com/shield-wall/myprofile/assets/6358755/a9b5f93b-4c2b-4479-98db-376260665ad5)
>> **Certification example 01**
>> *December 2019*

>
>> **Certification example 02**
>> *December 2020*
{% /block %}

{% /column %}
```

