let currentDate = new Date();
let selectedDate = null;

function generateCalendar() {
  const calendarDays = document.getElementById('calendarDays');
  calendarDays.innerHTML = '';

  const monthYear = document.getElementById('calendarMonthYear');
  const monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
                      "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
  monthYear.textContent = `${monthNames[currentDate.getMonth()]} ${currentDate.getFullYear()}`;

  const firstDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
  const lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);

  const prevLastDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), 0).getDate();
  const firstDayIndex = firstDay.getDay() === 0 ? 6 : firstDay.getDay() - 1;

  // Días del mes anterior
  for (let i = firstDayIndex; i > 0; i--) {
    const dayElement = document.createElement('div');
    dayElement.classList.add('calendar-day', 'other-month');
    dayElement.textContent = prevLastDay - i + 1;
    calendarDays.appendChild(dayElement);
  }

  // Días del mes actual
  for (let i = 1; i <= lastDay.getDate(); i++) {
    const dayElement = document.createElement('div');
    dayElement.classList.add('calendar-day');
    dayElement.textContent = i;

    const today = new Date();
    if (currentDate.getMonth() === today.getMonth() &&
        currentDate.getFullYear() === today.getFullYear() &&
        i === today.getDate()) {
      dayElement.classList.add('today');
    }

    if (selectedDate &&
        currentDate.getMonth() === selectedDate.getMonth() &&
        currentDate.getFullYear() === selectedDate.getFullYear() &&
        i === selectedDate.getDate()) {
      dayElement.classList.add('selected');
    }

    dayElement.addEventListener('click', () => selectDay(i));
    calendarDays.appendChild(dayElement);
  }

  // Días del siguiente mes
  const totalDays = firstDayIndex + lastDay.getDate();
  const daysLeft = 42 - totalDays;
  for (let i = 1; i <= daysLeft; i++) {
    const dayElement = document.createElement('div');
    dayElement.classList.add('calendar-day', 'other-month');
    dayElement.textContent = i;
    calendarDays.appendChild(dayElement);
  }
}

function selectDay(day) {
  selectedDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), day);
  document.querySelectorAll('.calendar-day').forEach(d => d.classList.remove('selected'));
  const selectedDay = Array.from(document.querySelectorAll('.calendar-day'))
    .find(d => parseInt(d.textContent) === day && !d.classList.contains('other-month'));
  if (selectedDay) selectedDay.classList.add('selected');
}

function toggleCalendar() {
  const overlay = document.getElementById('calendarOverlay');
  const calendar = document.getElementById('calendarContainer');
  const isVisible = calendar.style.display === 'block';
  calendar.style.display = isVisible ? 'none' : 'block';
  overlay.style.display = isVisible ? 'none' : 'block';
  if (!isVisible) generateCalendar();
}

document.addEventListener('DOMContentLoaded', () => {
  document.getElementById('viewCalendarBtn')?.addEventListener('click', toggleCalendar);
  document.getElementById('prevMonth')?.addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() - 1);
    generateCalendar();
  });
  document.getElementById('nextMonth')?.addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() + 1);
    generateCalendar();
  });
  document.getElementById('selectDate')?.addEventListener('click', () => {
    if (selectedDate) alert(`Fecha seleccionada: ${selectedDate.toLocaleDateString()}`);
    toggleCalendar();
  });
  document.getElementById('cancelCalendar')?.addEventListener('click', toggleCalendar);
  document.getElementById('calendarOverlay')?.addEventListener('click', toggleCalendar);
});
