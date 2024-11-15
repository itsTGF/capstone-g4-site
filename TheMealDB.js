let mealsData = [];

// fetch meal data
fetch("/meals")
  .then((response) => response.json())
  .then((data) => {
    mealsData = data;
    displayMeals(mealsData);
  })
  .catch((error) => console.error("Error:", error));

// function to display meals
function displayMeals(meals) {
  const tableBody = document.getElementById("mealsTable");
  tableBody.innerHTML = "";
  meals.forEach((meal) => {
    const row = `<tr>
                  <td>${meal.id}</td>
                  <td>${meal.name}</td>
                  <td>${meal.category}</td>
                  <td>${meal.area}</td>
                  <td>${meal.instructions}</td>
                  <td><img src="${meal.thumbnail_url}" alt="Meal Image"></td>
                  <td>${meal.tags}</td>
                </tr>`;
    tableBody.innerHTML += row;
  });
}

// function to filter and display meals from inputs
function filterMeals() {
  const tagFilter = document.getElementById("tagFilter").value.toLowerCase();
  const categoryFilter = document
    .getElementById("categoryFilter")
    .value.toLowerCase();
  const areaFilter = document.getElementById("areaFilter").value.toLowerCase();

  const filteredMeals = mealsData.filter((meal) => {
    const tagsMatch = tagFilter
      ? meal.tags && meal.tags.toLowerCase().includes(tagFilter)
      : true;
    const categoryMatch = categoryFilter
      ? meal.category && meal.category.toLowerCase().includes(categoryFilter)
      : true;
    const areaMatch = areaFilter
      ? meal.area && meal.area.toLowerCase().includes(areaFilter)
      : true;
    return tagsMatch && categoryMatch && areaMatch;
  });

  displayMeals(filteredMeals);
}

// add the event listeners to the filter input fields
document.getElementById("tagFilter").addEventListener("input", filterMeals);
document
  .getElementById("categoryFilter")
  .addEventListener("input", filterMeals);
document.getElementById("areaFilter").addEventListener("input", filterMeals);