

<template>
    <Head title="Welcome" />

<!-- Navigation -->
  <nav class="fixed flex justify-between py-6 w-full lg:px-48 md:px-12 px-4 content-center bg-secondary z-10">
    <div class="flex items-center">
      <img src="/images/ezbuy-logo.png" class="h-10"/>

    </div>
    <ul class="font-montserrat items-center hidden md:flex">
      <li class="mx-3 ">
        <a class="growing-underline" href="howitworks">
          How it works
        </a>
      </li>
      <li class="growing-underline mx-3">
        <a href="features">Features</a>
      </li>
      <li class="growing-underline mx-3">
        <a href="pricing">Pricing</a>
      </li>
    </ul>
    <div class="font-montserrat hidden md:block">

      <Link :href="route('login')" class="mr-6">Login</Link>
      <Link :href="route('register')" class="py-2 px-4 text-white bg-black rounded-3xl">
        Signup
      </Link>
    </div>
    <div id="showMenu" class="md:hidden">
      <Icon></Icon>
    </div>
  </nav>
  <div id='mobileNav' class="hidden px-4 py-6 fixed top-0 left-0 h-full w-full bg-secondary z-20 animate-fade-in-down">
    <div id="hideMenu" class="flex justify-end">
      <img src='dist/assets/logos/Cross.svg' alt="" class="h-16 w-16" />
    </div>
    <ul class="font-montserrat flex flex-col mx-8 my-24 items-center text-3xl">
      <li class="my-6">
        <a href="#howitworks">How it works</a>
      </li>
      <li class="my-6">
        <a href="features">Features</a>
      </li>
      <li class="my-6">
        <a href="pricing">Pricing</a>
      </li>
    </ul>
  </div>

  <!-- Hero -->
  <section
    class="pt-24 md:mt-0 md:h-screen flex flex-col justify-center text-center md:text-left md:flex-row md:justify-between md:items-center lg:px-48 md:px-12 px-4 bg-secondary">
    <div class="md:flex-1 md:mr-10">
      <h1 class="font-pt-serif text-5xl font-bold mb-7">
        E-ZBuy JA is an online shopping courier business in Jamaica
      </h1>
      <p class="font-pt-serif font-normal mb-7">
        EZBuy
        provides customers with a US address for shipping of their online purchases
      </p>
      <div class="font-montserrat">
        <Link :href="route('register')" class="bg-black px-6 py-4 rounded-lg border-2 border-black border-solid text-white mr-2 mb-2">
          Signup For Free Now
        </Link>

      </div>
    </div>
    <div class="flex justify-around md:block mt-8 md:mt-0 md:flex-1">
      <div class="relative">

    </div>
    </div>
  </section>

  <!-- How it works -->
  <section id="howitworks" class="bg-black text-white sectionSize">
    <div

    >
       <div>
      <h2 class="bg-100% bg-underline2 flex justify-center p-10 secondaryTitle text-3xl"
      >How it works</h2>
    </div>
    <div class="flex flex-col lg:px-48 md:flex-row">
      <div class="flex-1 mx-8 flex flex-col items-center my-4">
        <div class="border-2 rounded-full bg-secondary text-black h-12 w-12 flex justify-center items-center mb-3">
          1
        </div>
        <h3 class="font-montserrat font-medium text-xl mb-2">Eat</h3>
        <p class="text-center font-montserrat">
          Lorem ipsum dolor, sit amet consectetur adipisicing elit.
        </p>
      </div>
      <div class="flex-1 mx-8 flex flex-col items-center my-4">
        <div class="border-2 rounded-full bg-secondary text-black h-12 w-12 flex justify-center items-center mb-3">
          2
        </div>
        <h3 class="font-montserrat font-medium text-xl mb-2">Sleep</h3>
        <p class="text-center font-montserrat">
          Lorem ipsum dolor, sit amet consectetur adipisicing elit.
        </p>
      </div>
      <div class="flex-1 mx-8 flex flex-col items-center my-4">
        <div class="border-2 rounded-full bg-secondary text-black h-12 w-12 flex justify-center items-center mb-3">
          3
        </div>
        <h3 class="font-montserrat font-medium text-xl mb-2">Rave</h3>
        <p class="text-center font-montserrat">
          Lorem ipsum dolor, sit amet consectetur adipisicing elit.
        </p>
      </div>
    </div>
    </div>

  </section>

  <!-- Features -->


  <!-- Pricing -->

  <!-- FAQ  -->

  <!-- Footer -->
  <section class="bg-black sectionSize py-10 mt-12">

    <div class="text-white font-montserrat text-sm flex justify-center">
      © 2021 STARTUP. All rights reserved
    </div>
  </section>
</template>




<script>

import Icon from '@/Components/Icon.vue';
import { Head , Link} from '@inertiajs/inertia-vue3';

export default {
  components: {
    Icon,
    Link,
    Head,
  },
};
</script>
