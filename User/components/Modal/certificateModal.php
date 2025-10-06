<div id="certModal" class="fixed inset-0 hidden z-50 flex items-center justify-center px-4"
     style="background-color: rgba(15, 15, 40, 0.8); backdrop-filter: blur(6px);">
  
  <div class="relative w-full max-w-3xl rounded-3xl shadow-2xl overflow-hidden transform transition-transform duration-300 hover:scale-105"
       style="background: linear-gradient(135deg, rgb(245,245,255), rgb(230,225,255));
              border: 3px solid;
              border-image: linear-gradient(45deg, rgb(180,100,255), rgb(255,100,180)) 1;">
    
    <button id="closeCertModal"
            class="absolute top-4 right-4 text-2xl font-bold rounded-full p-2 transition-all duration-200 hover:scale-110 hover:bg-gradient-to-r from-pink-200 to-purple-200"
            style="color: rgb(80, 50, 120);">
      &times;
    </button>
    
    <div class="p-6 space-y-6">
      
      <h3 id="certTitle" class="text-2xl font-bold mb-4 border-b-2 pb-2"
          style="color: rgb(60, 20, 100); border-color: rgb(180, 100, 255);">
      </h3>
      
      <div id="certContent" class="w-full max-h-[75vh] overflow-auto flex flex-col items-center justify-center p-6 rounded-2xl"
           style="background: linear-gradient(145deg, rgb(235,230,255), rgb(245,240,255));
                  color: rgb(40, 30, 70);
                  border: 1px solid rgb(200,180,220);
                  box-shadow: 0 10px 25px rgba(100,80,180,0.2);">
      </div>
      
    </div>
    
  </div>
</div>
