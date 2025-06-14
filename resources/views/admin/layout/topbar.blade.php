 <header class="bg-white shadow-sm py-4 px-6 flex items-center justify-between sticky top-0 z-10">
     <div class="flex items-center">
         <button class="text-gray-500 focus:outline-none" onclick="toggleSidebar()">
             <i class="fas fa-bars"></i>
         </button>
         <div class="ml-4 relative">
             <input
                 class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-64"
                 placeholder="Search..." type="text">
             <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
         </div>
     </div>
     <div class="flex items-center space-x-4">
         <div class="relative">
             <button class="text-gray-500 focus:outline-none">
                 <i class="fas fa-bell"></i>
                 <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500"></span>
             </button>
         </div>
         <div class="flex items-center space-x-2">
             <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white">
                 <span>AD</span>
             </div>
             <span class="text-gray-700 font-medium">Admin</span>
             <i class="fas fa-chevron-down text-gray-500 text-xs"></i>
         </div>
     </div>
 </header>
