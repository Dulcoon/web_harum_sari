<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>Woodcraft Homeliving</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <link
    href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">


  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <style>
  body {
    font-family: "Oswald", sans-serif;
  }
  </style>
</head>

<body>
<x-navbar />

  <section id="section1" class="container h-screen min-w-full">
    <div class="atas h-1/2 bg-[#e2f8f6] relative">
      <div class="container min-w-full">
        <h1 class="text-4xl font-bold  text-center pt-10 text-black">Get In Touch</h1>
        <p class="text-center mt-1 mb-10 text-gray-500">Lorem ipsum dolor sit amet consectetur adipisicing elit.
          Sapiente vel voluptatem, expedita pariatur ad error ut unde facere doloremque animi.</p>
        <div class="card block lg:flex gap-4 md:flex bg-white shadow-md w-3/4 h-100 lg:h-96 mx-auto rounded-3xl p-3">
          <div class="kiri bg-[#00b8b0] w-full lg:w-1/3 rounded-2xl p-9 text-white">
            <h1 class="text-2xl">Contact Information</h1>
            <p class="text-sm text-gray-300">Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic, molestias?
            </p>
            <div class="hp flex gap-3 mt-5">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                <path fill-rule="evenodd"
                  d="M1.5 4.5a3 3 0 0 1 3-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 0 1-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 0 0 6.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 0 1 1.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 0 1-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5Z"
                  clip-rule="evenodd" />
              </svg>
              <p>08564564646</p>
            </div>
            <div class="email flex gap-3 mt-5">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                <path d="M1.5 8.67v8.58a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3V8.67l-8.928 5.493a3 3 0 0 1-3.144 0L1.5 8.67Z" />
                <path
                  d="M22.5 6.908V6.75a3 3 0 0 0-3-3h-15a3 3 0 0 0-3 3v.158l9.714 5.978a1.5 1.5 0 0 0 1.572 0L22.5 6.908Z" />
              </svg>

              <p>homelivingwoodcraft@gmail.com</p>
            </div>
            <div class="email flex gap-3 mt-5">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                <path fill-rule="evenodd"
                  d="m11.54 22.351.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"
                  clip-rule="evenodd" />
              </svg>
              <p>Pura Masuka Street, South Kuta, Badung Regency, Bali 80361, Indonesia.</p>
            </div>
          </div>
          <div class="kanan w-full lg:w-3/4 ">
            <form class="p-3 mx-auto" action="{{ route('email.send') }}" method="POST">
              @csrf
              @if (session('pesan'))
              <p style="color: green;">{{ session('pesan') }}</p>
              @endif
              <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 w-full mb-5 group">
                  <input type="email" name="email" id="email"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-[#00b8b0] focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " required />
                  <label for="email"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-[#00b8b0] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email
                    address</label>
                </div>
                <div class="relative z-0 w-screen-lg mb-5 group">
                  <input type="text" name="name" id="name"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-[#00b8b0] focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " required />
                  <label for="name"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-[#00b8b0] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Your
                    name</label>
                </div>
              </div>
              <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="phone" id="phone"
                  class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-[#00b8b0] focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                  placeholder=" " required />
                <label for="phone"
                  class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-[#00b8b0] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Your
                  phone number</label>
              </div>
              <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="subject" id="subject"
                  class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-[#00b8b0] focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                  placeholder=" " required />
                <label for="subject"
                  class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-[#00b8b0] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Subject</label>
              </div>
              <div class="relative z-0 w-full mb-5 group">
                <label for="message" class="block mb-2 text-sm font-medium text-gray-400">Your
                  message</label>
                <textarea id="message" name="message" rows="2"
                  class="block p-2.5 w-full text-sm text-gray-500 bg-gray-50 rounded-lg border-b-4 border-gray-300 focus:ring-blue-500 focus:border-[#00b8b0] dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-black "
                  placeholder="Leave a message..."></textarea>
              </div>

              <button type="submit"
                class="text-white bg-[#00b8b0] hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-[#00b8b0] dark:hover:bg-[#00b8b0] dark:focus:ring-[#268984]">Submit</button>
            </form>
          </div>
        </div>
      </div>


    </div>

  </section>



  <!-- Footer -->
  <div class="footer bg-[#f1f3f2] mt-56">
    <div class="container py-20 grid grid-cols-1 gap-44 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3">
      <div class="text-center">
        <h1 class="text-xl font-bold">PT. HARUM SARI</h1>
        <p class="text-sm">WOODCRAFT HOMELIVING</p>
      </div>
      <div class="text-center">
        <h1 class="text-xl font-bold">Categories</h1>
        <div class="mt-5">
          <a class="block" href="">Bedroom</a>
          <a class="block" href="">Livingroom</a>
          <a class="block" href="">Homewares</a>
          <a class="block" href="">Kids Furniture</a>
        </div>
      </div>
      <div class="text-center">
        <h1 class="text-xl font-bold">PT. HARUM SARI</h1>
        <p class="text-sm">WOODCRAFT HOMELIVING</p>
      </div>
    </div>
    <p class="text-center pb-8">&copy; 2024 Copyright: homeliving.co.id </p>
  </div>
  <!-- Footer end -->


  <script>
  document.getElementById('menu-btn').addEventListener('click', function() {
    var menu = document.getElementById('mobile-menu');
    if (menu.classList.contains('hidden')) {
      menu.classList.remove('hidden');
    } else {
      menu.classList.add('hidden');
    }
  });
  </script>
</body>

</html>