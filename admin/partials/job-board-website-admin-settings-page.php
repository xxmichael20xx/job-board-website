<div class="mx-auto w-full md:w-1/3 shadow-lg rounded bg-white mt-8 p-8">
    <h1 class="text-2xl">Job Board Website - Settings</h1>

    <div class="w-full mt-8">
        <form class="w-full" id="jbw-settings-form" method="POST">
            <div class="mb-4">
                <label for="api_email" class="block text-lg text-gray-700 font-bold mb-2">API Email</label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-lg text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    name="api_email"
                    id="api_email"
                    type="text"
                />
            </div>
            <div class="mb-4">
                <label for="api_password" class="block text-lg text-gray-700 font-bold mb-2">API Password</label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-lg text-gray-700 leading-tight"
                    name="api_password"
                    id="api_password"
                    type="password"
                />
            </div>
            <button
                type="submit"
                class="bg-blue-500 hover:bg-blue-900 text-white px-4 py-2 rounded text-lg mt-4 font-bold"
            >
                Submit
            </button>
        </form>
    </div>
</div>