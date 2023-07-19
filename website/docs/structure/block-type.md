---
sidebar_position: 2
---

# Blocks type

## Simple block

It's a generic block and you can use for things like `courses`, `certification`, `summary` and so on.

```markdown
{% block %}
## Your main title {% .icon-certification %}

> ![Logo 1](https://your-image-url)
>> **Title of something**
>> *sub title*

>
>> **Title 02 of something**
>> *sub title 02*
{% /block %}
```

Or you can use just for a simple text

```markdown
{% block %}
## Summary {% .icon-file-description %}

I'm a **Senior PHP Developer** *wi*th.
{% /block %}
```

Please look at [here](/structure/overview/#resume-example) to check the full example.