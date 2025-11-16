<?php include 'header.php'; ?>

<h1 class="text-3xl font-bold mb-10 text-center">Paramètres administrateurs</h1>
<div class="text-center font-semibold">
    <div class="grid md:grid-cols-2 gap-8 items-center my-6">
        <h2 class="text-xl">Gestion des rendez-vous</h2>
        <a href="index.php?page=appointmentsAdmin"
            class="py-4 text-2xl rounded-2xl bg-blue-900 text-white shadow-lg hover:bg-blue-500 transition">
            Rendez-vous
        </a>
    </div>
    <div class="h-[1px] w-[50%] bg-gray-500 mx-auto"></div>
    <div class="grid md:grid-cols-2 gap-8 items-center my-6">
        <a href="index.php?page=servicesAdmin"
            class="py-4 text-2xl rounded-2xl bg-blue-900 text-white shadow-lg hover:bg-blue-500 transition">
            Services
        </a>
        <h2 class="text-xl">Gestion des services proposés</h2>
    </div>
    <div class="h-[1px] w-[50%] bg-gray-500 mx-auto"></div>
    <div class="grid md:grid-cols-2 gap-8 items-center my-6">
        <h2 class="text-xl">Gestion des actualités</h2>
        <a href="index.php?page=postsAdmin"
            class="py-4 text-2xl rounded-2xl bg-blue-900 text-white shadow-lg hover:bg-blue-500 transition">
            Actualités
        </a>
    </div>
    <div class="h-[1px] w-[50%] bg-gray-500 mx-auto"></div>
    <div class="grid md:grid-cols-2 gap-8 items-center my-6">
        <a href="index.php?page=patientsAdmin"
            class="py-4 text-2xl rounded-2xl bg-blue-900 text-white shadow-lg hover:bg-blue-500 transition">
            Patients
        </a>
        <h2 class="text-xl">Gestion des patients</h2>
    </div>
    <div class="h-[1px] w-[50%] bg-gray-500 mx-auto"></div>
    <div class="grid md:grid-cols-2 gap-8 items-center my-6">
        <h2 class="text-xl">Gestion des horaires</h2>
        <a href="index.php?page=update-date"
            class="py-4 text-2xl rounded-2xl bg-blue-900 text-white shadow-lg hover:bg-blue-500 transition">
            Horaires
        </a>
    </div>
</div>

<?php include 'footer.php'; ?>