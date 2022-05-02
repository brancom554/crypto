/**
 * Copyright 2018 Google Inc. All Rights Reserved.
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *     http://www.apache.org/licenses/LICENSE-2.0
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

// If the loader is already loaded, just stop.
if (!self.define) {
  let registry = {};

  // Used for `eval` and `importScripts` where we can't get script URL by other means.
  // In both cases, it's safe to use a global var because those functions are synchronous.
  let nextDefineUri;

  const singleRequire = (uri, parentUri) => {
    uri = new URL(uri + ".js", parentUri).href;
    return registry[uri] || (
      
        new Promise(resolve => {
          if ("document" in self) {
            const script = document.createElement("script");
            script.src = uri;
            script.onload = resolve;
            document.head.appendChild(script);
          } else {
            nextDefineUri = uri;
            importScripts(uri);
            resolve();
          }
        })
      
      .then(() => {
        let promise = registry[uri];
        if (!promise) {
          throw new Error(`Module ${uri} didn’t register its module`);
        }
        return promise;
      })
    );
  };

  self.define = (depsNames, factory) => {
    const uri = nextDefineUri || ("document" in self ? document.currentScript.src : "") || location.href;
    if (registry[uri]) {
      // Module is already loading or loaded.
      return;
    }
    let exports = {};
    const require = depUri => singleRequire(depUri, uri);
    const specialDeps = {
      module: { uri },
      exports,
      require
    };
    registry[uri] = Promise.all(depsNames.map(
      depName => specialDeps[depName] || require(depName)
    )).then(deps => {
      factory(...deps);
      return exports;
    });
  };
}
define(['./workbox-5e427aa9'], (function (workbox) { 'use strict';

  /**
  * Welcome to your Workbox-powered service worker!
  *
  * You'll need to register this file in your web app.
  * See https://goo.gl/nhQhGp
  *
  * The rest of the code is auto-generated. Please don't update this file
  * directly; instead, make changes to your Workbox build configuration
  * and re-run your build process.
  * See https://goo.gl/2aRDsh
  */

  self.skipWaiting();
  /**
   * The precacheAndRoute() method efficiently caches and responds to
   * requests for URLs in the manifest.
   * See https://goo.gl/S9QRab
   */

  workbox.precacheAndRoute([{
    "url": "/js/core/app-menu.js",
    "revision": "c224f3353d68ec47657487a6f7536a01"
  }, {
    "url": "/js/core/app.js",
    "revision": "54d6a2d1f0163eb07a14902387d754ae"
  }, {
    "url": "/js/core/scripts.js",
    "revision": "8af03c9bd7a313a14a4ed04a1c0f1608"
  }, {
    "url": "/js/frontend/manifest.js",
    "revision": "078bdae8261d7f6ce6b9a38aa6296704"
  }, {
    "url": "/js/watchlist.js",
    "revision": "1e6908822e5f7b1cf9e6352358a420bc"
  }, {
    "url": "css-rtl/custom-rtl.css",
    "revision": "364c2cfe6693d654ed4f06c8f19137ee"
  }, {
    "url": "css-rtl/style-rtl.css",
    "revision": "4e0af4f61874c4088561d62f0de1dbd2"
  }, {
    "url": "css/base/core/colors/palette-gradient.css",
    "revision": "17110ecd46e89d9bda24c55b4faf8694"
  }, {
    "url": "css/base/core/colors/palette-noui.css",
    "revision": "cb81890f6716d65bdf9d16e3aecd0c6f"
  }, {
    "url": "css/base/core/colors/palette-variables.css",
    "revision": "68b329da9893e34099c7d8ad5cb9c940"
  }, {
    "url": "css/base/core/menu/menu-types/horizontal-menu.css",
    "revision": "c7c0d5be729805f32d372c32ea369f0f"
  }, {
    "url": "css/base/core/menu/menu-types/vertical-menu.css",
    "revision": "3e169b91c7d95dc0864edb07b445666b"
  }, {
    "url": "css/base/core/menu/menu-types/vertical-overlay-menu.css",
    "revision": "9b732a5fd845c0ca8ffdd308543ccd89"
  }, {
    "url": "css/base/core/mixins/alert.css",
    "revision": "68b329da9893e34099c7d8ad5cb9c940"
  }, {
    "url": "css/base/core/mixins/hex2rgb.css",
    "revision": "68b329da9893e34099c7d8ad5cb9c940"
  }, {
    "url": "css/base/core/mixins/main-menu-mixin.css",
    "revision": "68b329da9893e34099c7d8ad5cb9c940"
  }, {
    "url": "css/base/core/mixins/transitions.css",
    "revision": "68b329da9893e34099c7d8ad5cb9c940"
  }, {
    "url": "css/base/pages/app-calendar.css",
    "revision": "3d1ef944b86b737b47a8a241f431df98"
  }, {
    "url": "css/base/pages/app-chat-list.css",
    "revision": "2a46c3a3aef86aa146feaf3def5c0276"
  }, {
    "url": "css/base/pages/app-chat.css",
    "revision": "3c7e24668b76468277e80c8237ea57a1"
  }, {
    "url": "css/base/pages/app-ecommerce-details.css",
    "revision": "1ed9db8e308fc9a428cbc5f05b192352"
  }, {
    "url": "css/base/pages/app-ecommerce.css",
    "revision": "056c80080dc52c52671dbc6228fc6159"
  }, {
    "url": "css/base/pages/app-email.css",
    "revision": "83d56107e397792776a3375696c58cac"
  }, {
    "url": "css/base/pages/app-file-manager.css",
    "revision": "c6f87985623d66a952b47e12442e2020"
  }, {
    "url": "css/base/pages/app-invoice-list.css",
    "revision": "100a727835e3fae701fe87d270008c8a"
  }, {
    "url": "css/base/pages/app-invoice-print.css",
    "revision": "20ee25d970ffd636b5b79538820f8580"
  }, {
    "url": "css/base/pages/app-invoice.css",
    "revision": "2ca25f4f12bcf698bcc77d0966e96cf0"
  }, {
    "url": "css/base/pages/app-kanban.css",
    "revision": "b779a3a86b35b9376791f85c67399fb4"
  }, {
    "url": "css/base/pages/app-todo.css",
    "revision": "2918c6a36ffc1fe55afba68a7cd121b3"
  }, {
    "url": "css/base/pages/authentication.css",
    "revision": "990f38729f43624cf92d6b936eeff0a8"
  }, {
    "url": "css/base/pages/dashboard-ecommerce.css",
    "revision": "2ec72e88317630dc0a86accc234629c1"
  }, {
    "url": "css/base/pages/modal-create-app.css",
    "revision": "b4ee8bc1e587dc7c6727208ccfbe6ad3"
  }, {
    "url": "css/base/pages/page-blog.css",
    "revision": "6a7b4f2592ef15018bfc24fc61a46741"
  }, {
    "url": "css/base/pages/page-coming-soon.css",
    "revision": "b2928901328ab4b3a7b99a420a796c8c"
  }, {
    "url": "css/base/pages/page-faq.css",
    "revision": "4eafaf12ec87bc5cdeef6f714abe5633"
  }, {
    "url": "css/base/pages/page-knowledge-base.css",
    "revision": "60c2bef6b2cfc0c3772941994294ec77"
  }, {
    "url": "css/base/pages/page-misc.css",
    "revision": "560310296bd2b009c86b62bbb48141f2"
  }, {
    "url": "css/base/pages/page-pricing.css",
    "revision": "67ecf748034b0c9246ced47f5c2a6c34"
  }, {
    "url": "css/base/pages/page-profile.css",
    "revision": "5f563621b6dfca60c21bd914b20fb48f"
  }, {
    "url": "css/base/pages/ui-feather.css",
    "revision": "cf47589c6c6f4d46181c7c1cd322f5bf"
  }, {
    "url": "css/base/plugins/charts/chart-apex.css",
    "revision": "e392e8ccb5a2ea2c1afd964817ff3593"
  }, {
    "url": "css/base/plugins/extensions/ext-component-context-menu.css",
    "revision": "4d717afe86390a5e9cd41b49c0a0db01"
  }, {
    "url": "css/base/plugins/extensions/ext-component-drag-drop.css",
    "revision": "86346d0d8d728d02459f48c8cf5e1821"
  }, {
    "url": "css/base/plugins/extensions/ext-component-media-player.css",
    "revision": "47662d3a19ee4a6c0b479bebbdb0e279"
  }, {
    "url": "css/base/plugins/extensions/ext-component-ratings.css",
    "revision": "4a77a0e7009eb5f7920beb7d4c4e021d"
  }, {
    "url": "css/base/plugins/extensions/ext-component-sliders.css",
    "revision": "7dec2c9890cd6ee63c8ca3f191c82b42"
  }, {
    "url": "css/base/plugins/extensions/ext-component-sweet-alerts.css",
    "revision": "82afc712b8a66b2caac6eef85c13df8d"
  }, {
    "url": "css/base/plugins/extensions/ext-component-swiper.css",
    "revision": "8a868f53e6816a9c0a81dd0e8ec1d24f"
  }, {
    "url": "css/base/plugins/extensions/ext-component-toastr.css",
    "revision": "40593dd679cb75e15221403ae1a23d1a"
  }, {
    "url": "css/base/plugins/extensions/ext-component-tour.css",
    "revision": "26c25b0c67681b34002491091b96d462"
  }, {
    "url": "css/base/plugins/extensions/ext-component-tree.css",
    "revision": "c3a606b531a5bace32eeb01c83707c41"
  }, {
    "url": "css/base/plugins/forms/form-file-uploader.css",
    "revision": "267d497a6def277d3487124fec6ae6e0"
  }, {
    "url": "css/base/plugins/forms/form-number-input.css",
    "revision": "008f97e54843301c5d106b717a9e0384"
  }, {
    "url": "css/base/plugins/forms/form-quill-editor.css",
    "revision": "d869568d10b2072b2bcb106ea77c4507"
  }, {
    "url": "css/base/plugins/forms/form-validation.css",
    "revision": "b5c5846a944e1d5357466a5269c9280a"
  }, {
    "url": "css/base/plugins/forms/form-wizard.css",
    "revision": "50e28b2acca2abfe645f7cbdf8c02080"
  }, {
    "url": "css/base/plugins/forms/pickers/form-flat-pickr.css",
    "revision": "5b8eed07a073bebaef1dc58edb9397c1"
  }, {
    "url": "css/base/plugins/forms/pickers/form-pickadate.css",
    "revision": "826aab50911036130804fa9feae62891"
  }, {
    "url": "css/base/plugins/maps/map-leaflet.css",
    "revision": "c477fad84ab794628633d42e8be75939"
  }, {
    "url": "css/base/plugins/ui/coming-soon.css",
    "revision": "b6a00d89ca3c26be89b990cd2e087797"
  }, {
    "url": "css/base/themes/bordered-layout.css",
    "revision": "b52d76714c315e7fb7fc58a3ec7e9f99"
  }, {
    "url": "css/base/themes/dark-layout.css",
    "revision": "348ab9c38f8bda33a0a30453eab00ac7"
  }, {
    "url": "css/base/themes/semi-dark-layout.css",
    "revision": "10a6b305b5e69f6218bd336b8f255ac4"
  }, {
    "url": "css/core.css",
    "revision": "327b5e2f2a73a76425f116fcc39f0688"
  }, {
    "url": "css/overrides.css",
    "revision": "920ce2d3c5c4d0721d8874e060f80d89"
  }, {
    "url": "css/style.css",
    "revision": "68b329da9893e34099c7d8ad5cb9c940"
  }], {});
  workbox.registerRoute(/\.(?:png|jpg|jpeg|svg|js|css|woff2)$/, new workbox.CacheFirst({
    "cacheName": "images",
    plugins: []
  }), 'GET');

}));
//# sourceMappingURL=service-worker.js.map
