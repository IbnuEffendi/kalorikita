<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab Kalori - KaloriKita</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <style>
        body { font-family: 'Instrument Sans', sans-serif; }
    </style>
</head>

<body class="bg-green-900 text-gray-900">

    <section id="lab-section" class="w-full min-h-screen flex justify-center items-center py-20 px-4">

        <div class="relative w-full max-w-6xl bg-green-800 rounded-[2.5rem] shadow-2xl p-8 md:p-12">
            
            <form action="#" method="POST"> 
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20">

                    <div class="flex flex-col items-center w-full">
                        
                        <div class="text-center mb-8">
                            <h2 class="text-2xl font-semibold text-white mb-2">Informasi Personal</h2>
                            <div class="h-1 w-16 bg-yellow-400 mx-auto rounded-full"></div>
                        </div>

                        <div class="flex justify-center gap-6 mb-8 w-full max-w-md">
                            <label class="cursor-pointer group w-1/2"> <input type="radio" name="gender" value="male" class="hidden peer" />
                                <div class="flex flex-col items-center gap-3 border-2 border-transparent bg-white peer-checked:bg-[#DAEFA2] peer-checked:border-green-400 rounded-2xl px-4 py-6 transition-all shadow-md hover:scale-105 w-full h-full justify-center">
                                    <img src="/asset/laki.png" alt="Laki-laki" class="w-16 h-16 object-contain">
                                    <span class="text-sm font-bold text-gray-800">Laki-Laki</span>
                                </div>
                            </label>

                            <label class="cursor-pointer group w-1/2"> <input type="radio" name="gender" value="female" class="hidden peer" />
                                <div class="flex flex-col items-center gap-3 border-2 border-transparent bg-white peer-checked:bg-[#DAEFA2] peer-checked:border-green-400 rounded-2xl px-4 py-6 transition-all shadow-md hover:scale-105 w-full h-full justify-center">
                                    <img src="/asset/perempuan.png" alt="Perempuan" class="w-16 h-16 object-contain">
                                    <span class="text-sm font-bold text-gray-800">Perempuan</span>
                                </div>
                            </label>
                        </div>

                        <span class="text-sm text-red-400 font-bold drop-shadow-md block mb-6 text-center animate-pulse">
                            *Lengkapi Data Diri Anda
                        </span>

                        <div class="flex flex-col items-center space-y-4 w-full max-w-md">
                            <input type="text" placeholder="Usia (Tahun)" 
                                class="w-full bg-white rounded-xl px-6 py-3 text-center font-medium placeholder:text-gray-400 focus:outline-none focus:ring-4 focus:ring-green-500/50 shadow-inner">
                            
                            <input type="text" placeholder="Tinggi Badan (Cm)" 
                                class="w-full bg-white rounded-xl px-6 py-3 text-center font-medium placeholder:text-gray-400 focus:outline-none focus:ring-4 focus:ring-green-500/50 shadow-inner">
                            
                            <input type="text" placeholder="Berat Badan (Kg)" 
                                class="w-full bg-white rounded-xl px-6 py-3 text-center font-medium placeholder:text-gray-400 focus:outline-none focus:ring-4 focus:ring-green-500/50 shadow-inner">
                        </div>
                    </div>

                    <div class="lg:hidden w-full h-0.5 bg-green-700/50"></div>

                    <div class="flex flex-col items-center justify-between w-full h-full">
                        
                        <div class="w-full flex flex-col items-center mb-10">
                            <h3 class="text-2xl font-semibold text-white mb-2">Aktivitas</h3>
                            <div class="h-1 w-12 bg-yellow-400 mb-8 rounded-full"></div>
                            
                            <div class="grid grid-cols-3 gap-4 w-full max-w-md"> 
                                <label class="cursor-pointer">
                                    <input type="radio" name="aktivitas" value="ringan" class="hidden peer" />
                                    <div class="h-20 flex items-center justify-center bg-white text-gray-700 font-bold rounded-xl border-2 border-transparent peer-checked:bg-[#DAEFA2] peer-checked:text-green-800 peer-checked:border-green-500 transition-all hover:bg-gray-50 px-2 text-center text-sm sm:text-base">Ringan</div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="aktivitas" value="sedang" class="hidden peer" />
                                    <div class="h-20 flex items-center justify-center bg-white text-gray-700 font-bold rounded-xl border-2 border-transparent peer-checked:bg-[#DAEFA2] peer-checked:text-green-800 peer-checked:border-green-500 transition-all hover:bg-gray-50 px-2 text-center text-sm sm:text-base">Sedang</div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="aktivitas" value="berat" class="hidden peer" />
                                    <div class="h-20 flex items-center justify-center bg-white text-gray-700 font-bold rounded-xl border-2 border-transparent peer-checked:bg-[#DAEFA2] peer-checked:text-green-800 peer-checked:border-green-500 transition-all hover:bg-gray-50 px-2 text-center text-sm sm:text-base">Berat</div>
                                </label>
                            </div>
                        </div>

                        <div class="w-full max-w-md h-0.5 bg-green-600/30 mb-10"></div> 

                        <div class="w-full flex flex-col items-center">
                            <h3 class="text-2xl font-semibold text-white mb-2">Tujuan</h3>
                            <div class="h-1 w-12 bg-yellow-400 mb-8 rounded-full"></div>
                            
                            <div class="grid grid-cols-3 gap-4 w-full max-w-md">
                                <label class="cursor-pointer">
                                    <input type="radio" name="tujuan" value="turun" class="hidden peer" />
                                    <div class="h-20 flex items-center justify-center bg-white text-gray-700 font-bold rounded-xl border-2 border-transparent peer-checked:bg-[#DAEFA2] peer-checked:text-green-800 peer-checked:border-green-500 transition-all hover:bg-gray-50 px-2 text-center text-sm sm:text-base">Turun</div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="tujuan" value="pertahankan" class="hidden peer" />
                                    <div class="h-20 flex items-center justify-center bg-white text-gray-700 font-bold rounded-xl border-2 border-transparent peer-checked:bg-[#DAEFA2] peer-checked:text-green-800 peer-checked:border-green-500 transition-all hover:bg-gray-50 px-2 text-center text-xs sm:text-sm font-bold leading-tight">Pertahankan</div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="tujuan" value="naik" class="hidden peer" />
                                    <div class="h-20 flex items-center justify-center bg-white text-gray-700 font-bold rounded-xl border-2 border-transparent peer-checked:bg-[#DAEFA2] peer-checked:text-green-800 peer-checked:border-green-500 transition-all hover:bg-gray-50 px-2 text-center text-sm sm:text-base">Naik</div>
                                </label>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="relative flex flex-col sm:flex-row justify-center gap-6 mt-16">
                    <button type="submit" class="bg-yellow-400 hover:bg-yellow-300 text-green-900 font-bold text-lg px-12 py-3 rounded-full shadow-lg transition-all transform hover:-translate-y-1">Hitung</button>
                    <button type="reset" class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-green-900 font-bold text-lg px-12 py-3 rounded-full shadow-lg transition-all transform hover:-translate-y-1">Reset</button>
                </div>

            </form>
        </div>
    </section>

</body>
</html>