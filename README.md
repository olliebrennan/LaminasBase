# LaminasBase

Version 0.0.1 Created by Flávio Gomes da Silva Lisboa from ZfcBase

## Introduction

LaminasBase provides a suite of common classes used across several Laminas modules.
You probably don't need to install this module unless either 

A) you are
installing a module that depends on LaminasBase, or 

B) you are building a module
that depends on LaminasBase.

## Requirements

* Laminas

## Installation

Simply clone this project into your `./vendor/` directory and enable it in your
`./config/application.config.php` file.

Provided Classes
----------------

* `LaminasBase\Mapper\AbstractDbMapper` - An abstract mapper for Laminas\Db that makes
  using hydrators and custom entities very simple.
* `LaminasBase\Form\ProvidesEventsForm` - Extends Laminas\Form and provides the
  functionality of `LaminasBase\EventManager\EventProvider` (basically it's a
  crutch since we can't use traits yet).
* `LaminasBase\EventManager\EventProvider` - Abstract class that gives extending
  classes an event manager and related methods.
