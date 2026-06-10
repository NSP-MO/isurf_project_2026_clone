// isurf-api.js
const iSurfAPI = {
    baseUrl: typeof apiBaseUrl !== 'undefined' ? apiBaseUrl : 'http://localhost:8000/api',

    async getLatestReadings() {
        try {
            const response = await fetch(`${this.baseUrl}/readings/latest`);
            if (!response.ok) throw new Error('Network response was not ok');
            return await response.json();
        } catch (error) {
            console.error('Error fetching latest readings:', error);
            return null;
        }
    },

    async getDevices() {
        try {
            const response = await fetch(`${this.baseUrl}/devices`);
            if (!response.ok) throw new Error('Network response was not ok');
            return await response.json();
        } catch (error) {
            console.error('Error fetching devices:', error);
            return [];
        }
    }
};
