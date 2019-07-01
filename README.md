# CoCart

[![WordPress Plugin Page](https://img.shields.io/badge/WordPress-%E2%86%92-lightgrey.svg?style=flat-square)](https://wordpress.org/plugins/cart-rest-api-for-woocommerce/)
[![WordPress Plugin Version](https://img.shields.io/wordpress/plugin/v/cart-rest-api-for-woocommerce.svg?style=flat)](https://wordpress.org/plugins/cart-rest-api-for-woocommerce/)
[![WordPress Tested Up To](https://img.shields.io/wordpress/v/cart-rest-api-for-woocommerce.svg?style=flat)](https://wordpress.org/plugins/cart-rest-api-for-woocommerce/)
[![WordPress Plugin Rating](https://img.shields.io/wordpress/plugin/r/cart-rest-api-for-woocommerce.svg)](https://wordpress.org/plugins/cart-rest-api-for-woocommerce/#reviews)
[![WordPress Plugin Downloads](https://img.shields.io/wordpress/plugin/dt/cart-rest-api-for-woocommerce.svg)](https://wordpress.org/plugins/cart-rest-api-for-woocommerce/)
[![License](https://img.shields.io/badge/license-GPL--3.0%2B-red.svg)](https://github.com/co-cart/co-cart/blob/master/LICENSE.md)

**Contributors:** sebd86  
**Donate link:** https://sebdumont.xyz/donate/  
**Tags:** woocommerce, cart, rest, rest-api, JSON  
**Requires at least:** 4.9.8  
**Requires PHP:** 5.6  
**Tested up to:** 5.2.2  
**WC requires at least:** 3.0.0  
**WC tested up to:** 3.6.4  
**Stable tag:** 1.2.3  
**License:** GPL v2 or later  

Control the cart via the REST-API for WooCommerce.

## 🔔 Overview

CoCart, also written as co-cart, is a REST API extension for WooCommerce. Accessing the cart via the REST API was highly requested by mobile and app developers and was missing from the core of WooCommerce.

So I built it. Tada!

It allows you to use WooCommerce’s REST API to its full potential providing the option to create a full web or mobile app 📱 for your store powered by WooCommerce.

### Is This Free?

Yes, it's free. But here's what you should _really_ care about:

* The code adheres to the [WordPress Coding Standards](https://codex.wordpress.org/WordPress_Coding_Standards) and follows best practices and conventions.
* There is nothing else out there.

> None of the official WooCommerce library wrappers can be used with this REST API as they all require authentication which makes it difficult to use along with the other official REST API endpoints that WooCommerce provides.

### What's the Catch?

This is a non-commercial plugin. As such:

* Development time for it is effectively being donated and is, therefore, limited.
* Support inquiries may not be answered in a timely manner.
* Critical issues may not be resolved promptly.

If you have a customization/integration requirement then I'd love to [hear from you](https://cocart.xyz/feedback/).

Please understand that this repository is not a place to seek help with configuration-related issues. Use it to report bugs or propose improvements.

If you are looking for ways to customize CoCart, [check out the tweaks repository](https://github.com/co-cart/co-cart-tweaks) for some examples.

## 📘 Guide

### 📖 Documentation

[View documentation for CoCart](https://co-cart.github.io/co-cart-docs/). Documentation currently only has examples for using with _cURL_. If you are interested to share how to use CoCart in other languages, please follow the [contributing guidelines in the documenation repository](https://github.com/co-cart/co-cart-docs/blob/master/CONTRIBUTING.md).

#### ✅ Requirements

To use this plugin you will need:

* PHP v5.6 minimum (Recommend PHP v7+)
* WordPress v4.9.8 minimum
* WooCommerce v3.6.0+
* Pretty permalinks in Settings > Permalinks so that the custom endpoints are supported. **Default permalinks will not work.**
* You may access the API over either HTTP or HTTPS, but HTTPS is recommended where possible.

#### 💽 Installation

##### Manual

1. Download a `.zip` file with the [latest version](https://github.com/co-cart/co-cart/releases).
2. Go to **WordPress Admin > Plugins > Add New**.
3. Click **Upload Plugin** at the top.
4. **Choose File** and select the `.zip` file you downloaded in **Step 1**.
5. Click **Install Now** and **Activate** the plugin.

##### Automatic

1. Go to **WordPress Admin > Plugins > Add New**.
2. Search for **CoCart**
3. Click **Install Now** on the plugin and **Activate** the plugin.

### Usage

To view the cart endpoint, go to `yourdomainname.xyz/wp-json/cocart/v1/get-cart/`

See [documentation](#-documentation) on how to use all endpoints.

## ⭐ Support

CoCart is released freely and openly. [Feedback or ideas](https://cocart.xyz/feedback/) and approaches to solving limitations in CoCart is greatly appreciated.

CoCart is not supported via the [WooCommerce Helpdesk](https://woocommerce.com/). As the plugin is not sold via WooCommerce.com, the support team at WooCommerce.com is not familiar with it and may not be able to assist.

At present, I **do not offer a dedicated, premium support channel** for CoCart but will soon with CoCart Pro. Please understand this is a non-commercial plugin. As such:

* Development time for it is effectively being donated and is, therefore, limited.
* Support inquiries may not be answered in a timely manner.
* Critical issues may not be resolved promptly.

### 📝 Reporting Issues

If you think you have found a bug in the plugin, a problem with the documentation, or want to see a new feature added, please [open a new issue](https://github.com/co-cart/co-cart/issues/new) and I will do my best to help you out.

## Contribute

If you would like to contribute code to this project then please follow these [contribution guidelines](https://github.com/co-cart/co-cart/blob/master/CONTRIBUTING.md).

Please consider starring ✨ and sharing 👍 the project repo! This helps the project getting known and grow with the community. 🙏

Thank you for your support! 🙌

---

##### License

CoCart is released under [GNU General Public License v3.0](http://www.gnu.org/licenses/gpl-3.0.html).

##### Credits

CoCart is developed and maintained by [Sébastien Dumont](https://github.com/seb86).

---

<p align="center">
    <img src="https://raw.githubusercontent.com/seb86/my-open-source-readme-template/master/a-sebastien-dumont-production.png" width="353">
</p>
