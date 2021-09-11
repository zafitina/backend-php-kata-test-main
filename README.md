# Refactoring Kata Test

## Introduction

**Ornikar** is sending a lot of notification messages, and we have some message templates we want to send
at different occasion. To do that, we've developed `TemplateManager` whose job is to replace
placeholders in texts by lesson related information.

`TemplateManager` is a class that's been around for years and nobody really knows who coded
it or how it really works. Nonetheless, as the business changes frequently, this class has
already been modified many times, making it harder to understand at each step.

Today, once again, the PO wants to add some new stuff to it and add the management for a new
placeholder. But this class is already complex enough and just adding a new behaviour to it
won't work this time.

Your mission, should you decide to accept it, is to **refactor `TemplateManager` to make it
understandable by the next developer** and easy to change afterwards. Now is the time for you to
show your exceptional skills and make this implementation better, extensible, and ready for future
features.

Sadly for you, the public method `TemplateManager::getTemplateComputed` is called everywhere, 
and **you can't change its signature**. But that's the only one you can't modify (unless explicitly
forbidden in a code comment), **every other class is ready for your changes**.

This exercise **should not last longer than 1 hour 30** (but this can be too short to do it all and
you might take longer if you want).


## Rules
There are some rules to follow:
 - You must commit regularly
 - You must not modify code when comments explicitly forbid it

## Deliverables
What do we expect from you:
 - the link of the git repository
 - several commits, with an explicit message each time
 - a file / message / email explaining your process and principles you've followed

## Hints
- You will be evaluated on your usage of SOLID principle and Refactoring best practices.
- A makefile is provided for you to help you start directly with docker.

**Good luck!**
