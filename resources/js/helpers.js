import { addDays, format, isSunday } from 'date-fns';
export function addDaysWithoutSundays (startDate, daysToAdd) {
    // Initialize a counter to keep track of the days added
    let daysAdded = 0;
    startDate = new Date(startDate);
    // Loop until you've added the desired number of days
    while (daysAdded < daysToAdd) {
        // Add one day to the start date
        startDate = addDays(startDate, 1);

        // Check if the current day is a Sunday
        if (isSunday(startDate)) {
            // Skip this day (Sunday) and continue to the next day
            continue;
        }

        // Increment the counter for added days
        daysAdded++;
    }

    // The startDate now holds the desired future date, ignoring Sundays
    const futureDate = startDate;

    // Format the future date as needed
    return  format(futureDate, 'yyyy-MM-dd');
}