document.addEventListener('DOMContentLoaded', function () {
    function approveFarmOwner(id) {
        fetch(`/admin/farm-owners/${id}/approve`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.reload();
            }
        });
    }

    function showTab(tabName) {

        document.getElementById('users-content').classList.add('hidden');
        document.getElementById('farm-owners-content').classList.add('hidden');

        document.getElementById(`${tabName}-content`).classList.remove('hidden');


        const tabs = ['users-tab', 'farm-owners-tab'];
        tabs.forEach(tab => {
            const element = document.getElementById(tab);
            element.classList.remove('text-green-500', 'border-green-500', 'active');
            element.classList.add('text-gray-500', 'border-transparent');
            element.classList.remove('dark:text-green-500', 'dark:border-green-500');
            element.classList.add('dark:text-gray-400', 'dark:hover:text-gray-300');
        });


        const activeTab = document.getElementById(`${tabName}-tab`);
        activeTab.classList.remove('text-gray-500', 'border-transparent');
        activeTab.classList.remove('dark:text-gray-400', 'dark:hover:text-gray-300');
        activeTab.classList.add('text-green-500', 'border-green-500', 'active');
        activeTab.classList.add('dark:text-green-500', 'dark:border-green-500');


        const activeSvg = activeTab.querySelector('svg');
        if (activeSvg) {
            activeSvg.classList.remove('text-gray-400', 'group-hover:text-gray-500');
            activeSvg.classList.remove('dark:text-gray-500', 'dark:group-hover:text-gray-300');
            activeSvg.classList.add('text-green-500');
            activeSvg.classList.add('dark:text-green-500');
        }


        tabs.forEach(tab => {
            if (tab !== `${tabName}-tab`) {
                const svg = document.getElementById(tab).querySelector('svg');
                if (svg) {
                    svg.classList.remove('text-green-500', 'dark:text-green-500');
                    svg.classList.add('text-gray-400', 'group-hover:text-gray-500');
                    svg.classList.add('dark:text-gray-500', 'dark:group-hover:text-gray-300');
                }
            }
        });
    }

    window.showTab = showTab;

    document.addEventListener('DOMContentLoaded', function () {

        const userModal = document.getElementById('userModal');
        const userForm = document.getElementById('userForm');
        const modalTitle = document.getElementById('modalTitle');


        showTab('users');
    });

    window.approveFarmOwner = approveFarmOwner;
})
