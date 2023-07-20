<nav class="bg-white relative flex justify-between lg:divide-x divide-black border-t lg:border-t-0 border-b border-black z-20" aria-label="Global">
    <div class="flex w-24 lg:justify-center flex-grow-1 lg:flex-grow-0 lg:w-40 border-r border-black lg:border-none">
      <a href="<?= get_home_url(); ?>" class="transition hover:bg-gray-100 w-full">
        <span class="sr-only">Modinex</span>
        <img src="<?= get_template_directory_uri() . '/assets/dist/img/logo/Modinex_Logo_Icon_Positive_Transparent_RGB.png'; ?>" alt="Modinex" class="h-16 lg:h-24 mx-auto">
      </a>
    </div>
    <div class="flex items-center justify-center flex-grow-1 px-8 mr-auto flex-shrink-0 lg:hidden">
      <a href="tel:<?= get_field('site_phone_number', 'option'); ?>" class="transition hover:bg-gray-100 w-full">
        <span class="sr-only">Call Now on <?= get_field('site_phone_number', 'option'); ?></span>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
        </svg>
      </a>
    </div>
    <div class="order-last flex-grow-1 lg:flex-grow-0 flex items-center justify-center border-l border-black lg:hidden w-24">
      <button id="openMenuButton" type="button" class="w-full h-full inline-flex items-center justify-center rounded-md p-2.5 text-gray-700"">
        <span class="sr-only">Open main menu</span>
        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
      </button>
    </div>
    <div class="hidden lg:flex lg:justify-center lg:flex-1 lg:flex-wrap-reverse">
      <div class="flex-1 xl:flex-none lg:flex lg:justify-center">
        <?= klyp_generate_mega_menu('Global Navigation'); ?>
      </div>
        <div class="flex gap-4 self-center lg:px-4 lg:py-2">
            <a class="border border-black flex justify-between items-center gap-2 rounded-full text-black py-2 px-4" href="<?= site_url('contact-us'); ?>"><span>Enquire Now</span></a>
            <a class="border border-black flex justify-between items-center gap-2 rounded-full text-black py-2 px-4" href="tel:<?= get_field('site_phone_number', 'option'); ?>">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
              </svg>
              <?= get_field('site_phone_number', 'option'); ?>
            </a>
        </div>
    </div>
    <div class="order-2 lg:order-none flex lg:items-center lg:justify-center lg:w-40">
        <button class="px-8 lg:px-0 mn-header__search w-full h-full flex items-center justify-center" type="button" data-toggle="collapse">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
        </button>
    </div>
    <div class="mn-header__search-con overflow-auto">
      <div class="max-w-screen-lg xl:max-w-screen-xl mx-auto w-full px-8 py-6">
        <form action="<?= get_home_url(); ?>" role="search" class="mn-header__search-form relative">
            <div class="relative">
                <div class="flex border-b border-black items-center sticky top-0 bg-white">
                  <input type="text" role="search" class="mn-header__search-box text-2xl flex-1 border-0" placeholder="Start typing to search" >
                  <div class="p-4">
                    <img src="<?= get_template_directory_uri(); ?>/assets/dist/img/close.png" alt="" class="mn-header__search-close w-4 h-4">
                  </div>
                </div>
                <div class="mn-header__search-results py-6">
                    <img src="<?= get_template_directory_uri(); ?>/assets/dist/img/loading.gif" class="loading_gif"/>
                    <div class="grid grid-cols-1 lg:grid-cols-12 lg:divide-x lg:divide-black">
                        <div class="lg:col-span-2 p-4 mns__previous_search">
                            <h4 class="text-xl mb-4">Previous Search</h4>
                            <ul class="previous_search_list list-none flex flex-col gap-2"></ul>
                        </div>
                        <div class="lg:col-span-10 mn-header__search-results_list"></div>
                    </div>
                </div>
            </div>
        </form>
      </div>
    </div>
  </nav>

  <!-- Mobile menu, show/hide based on menu open state. -->
  <div id="mobileMenu" class="-translate-y-full h-webkit-fill z-10 flex fixed inset-0 transition duration-200 lg:hidden" role="dialog" aria-modal="true">
    <!-- Background backdrop, show/hide based on slide-over state. -->
    <div class="fixed inset-0 z-10"></div>
    <div class="absolute inset-y-0 right-0 z-20 w-full h-full overflow-auto bg-white px-6 pt-16 pb-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
      <div class="hidden flex items-center justify-between">
      </div>
      <div class="mt-6 flow-root">
        <div class="-my-6 divide-y divide-gray-500/10">
          <div class="space-y-2 py-6 text-lg">
            <?= klyp_generate_mobile_menu('Global Navigation'); ?>
        </div>
      </div>
    </div>
  </div>
  </div>