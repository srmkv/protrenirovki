import json

import requests
from bs4 import BeautifulSoup


def str_get_digits(string):
    return int(''.join(filter(str.isdigit, string)))


def get_steps(bs_obj):
    steps = []
    if bs_obj.css.select("#pt_steps"):
        for step in bs_obj.css.select("#pt_steps > .instructions > li:not(.as-ad-step)"):
            steps.append(step.css.select_one("p.instruction").get_text())
    return steps


def get_ingredients(bs_obj):
    ingredients = []

    for ingredient in bs_obj.css.select('#recept-list > .ingredient'):
        info_element = ingredient.css.select_one("span.ingredient-info")
        info = info_element.get_text() if info_element else ""
        amount = ingredient.css.select_one("span.squant").get_text()
        if amount:
            unit = ingredient.css.select_one("select.recalc_s_num > option:checked")
            amount += " " + unit.get_text() if unit else ingredient.css.select_one(".no-shrink > span.type").get_text()
        else:
            amount = ingredient.css.select_one('.no-shrink > span.type').get_text()

        ingredients.append({
            "name": ingredient.css.select_one("a.name").get_text(),
            "ingredient_info": info,
            "amount": amount
        })
    return ingredients


def get_method_preparation(bs_obj):
    prep_method = bs_obj.css.select(".method-preparation > .instructions > p")
    if prep_method:
        return ''.join(str(prep_method))
    elif bs_obj.css.select_one(".method-preparation > div"):
        return bs_obj.css.select_one(".method-preparation > div").get_text()

    return ""


BASE_URL = "https://1000.menu"

CATEGORY_URL = BASE_URL + "/catalog/pp-recepty"

res = requests.get(CATEGORY_URL)

bs = BeautifulSoup(res.text, 'html.parser')

page_count = str_get_digits(bs.css.select('.search-pages > a')[-1].get_text())

dishes = []

dish_counter = 0

for page in range(1, page_count + 1):

    bs = BeautifulSoup(requests.get(f'{CATEGORY_URL}/{page}').text, 'html.parser')
    items = bs.css.select('.cooking-block > .cn-item:not(.ads_enabled)')

    for item in items:
        # Displaying progress
        print(f'Parsed items: {dish_counter}', end='\r')

        link = item.css.select_one('.photo > a')['href']
        bs_item = BeautifulSoup(requests.get(BASE_URL + link).text, 'html.parser')
        try:
            dish_item = {
                "name": bs_item.css.select_one('h1[itemprop=name]').get_text(),
                "description": bs_item.css.select_one('div[itemprop=description]').get_text(),
                "cooking_time": bs_item.css.select_one('.label-with-icon > .label > strong').get_text(),
                'ingredients': get_ingredients(bs_item),
                "steps": get_steps(bs_item),
                "image": bs_item.css.select_one(".main-photo > a > img")['src'],
                "energy": bs_item.css.select_one("#nutr_kcal").get_text(),
                "method_preparation": get_method_preparation(bs_item)
            }
            dishes.append(dish_item)
        except Exception as e:
            print(e)
            print("Error at page: " + link)

        dish_counter += 1

        output_file = open("./output.json", "w+")
        output_file.write(json.dumps(dishes))
        output_file.close()


