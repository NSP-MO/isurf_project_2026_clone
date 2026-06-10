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
    },

    async getDeviceSensors(deviceId) {
        // We might need to fetch a specific device and its sensors or use a dedicated endpoint
        // Let's assume we can fetch sensors via GET /api/readings/latest which has sensors,
        // OR better yet, just fetch from GET /api/devices/{deviceId}/sensors if it exists.
        // Wait, does GET /devices/{device_id} return its sensors?
        // Let's create a dedicated GET /devices/{device_id}/sensors in the backend if not.
        // Wait, the python code for Device model usually has `sensors = relationship("Sensor")`.
        try {
            const response = await fetch(`${this.baseUrl}/devices/${deviceId}`);
            if (!response.ok) throw new Error('Network response was not ok');
            const data = await response.json();
            // In typical FastAPI setup with lazy loading, it might not return sensors unless configured in schema.
            // But we will handle it in PHP / JS. We will see.
            return data;
        } catch (error) {
            console.error('Error fetching device sensors:', error);
            return null;
        }
    },

    async updateSensorThreshold(deviceId, sensorId, minThreshold, maxThreshold) {
        try {
            const response = await fetch(`${this.baseUrl}/devices/${deviceId}/sensors/${sensorId}/thresholds`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    min_threshold: minThreshold !== "" ? parseFloat(minThreshold) : null,
                    max_threshold: maxThreshold !== "" ? parseFloat(maxThreshold) : null
                })
            });
            if (!response.ok) throw new Error('Failed to update threshold');
            return await response.json();
        } catch (error) {
            console.error('Error updating threshold:', error);
            throw error;
        }
    }
};
