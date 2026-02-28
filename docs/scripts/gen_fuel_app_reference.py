"""Generate MkDocs pages for README assets and the fuel/app PHP code tree."""

from collections import defaultdict
from pathlib import Path

import mkdocs_gen_files

REPO_ROOT = Path(__file__).resolve().parents[2]
FUEL_APP_ROOT = REPO_ROOT / "fuel" / "app"
IMAGES_ROOT = REPO_ROOT / "images"
REFERENCE_ROOT = Path("reference") / "fuel-app"


def humanize(segment: str) -> str:
    """Convert a path segment into a display title."""
    return segment.replace("-", " ").replace("_", " ").title()


def copy_readme_images() -> None:
    """Expose root README images to docs so README embeds resolve."""
    if not IMAGES_ROOT.exists():
        return

    for image_path in sorted(IMAGES_ROOT.rglob("*")):
        if not image_path.is_file():
            continue
        if image_path.name.startswith("."):
            continue

        output_path = image_path.relative_to(REPO_ROOT).as_posix()
        with mkdocs_gen_files.open(output_path, "wb") as image_file:
            image_file.write(image_path.read_bytes())


def write_fuel_app_reference() -> None:
    """Generate one markdown page per PHP file under fuel/app and an index."""
    grouped_files: dict[str, list[tuple[Path, Path]]] = defaultdict(list)

    for source_path in sorted(FUEL_APP_ROOT.rglob("*.php")):
        repo_relative = source_path.relative_to(REPO_ROOT)
        app_relative = source_path.relative_to(FUEL_APP_ROOT)
        output_path = REFERENCE_ROOT / app_relative.with_suffix(".md")
        top_level_group = app_relative.parts[0] if app_relative.parts else "root"
        grouped_files[top_level_group].append((app_relative, output_path))

        with mkdocs_gen_files.open(output_path.as_posix(), "w") as markdown_file:
            markdown_file.write(f"# `{repo_relative.as_posix()}`\n\n")
            markdown_file.write("```php linenums=\"1\"\n")
            markdown_file.write(f'--8<-- "{repo_relative.as_posix()}"\n')
            markdown_file.write("```\n")

        mkdocs_gen_files.set_edit_path(output_path.as_posix(), repo_relative.as_posix())

    overview_path = REFERENCE_ROOT / "index.md"
    with mkdocs_gen_files.open(overview_path.as_posix(), "w") as overview:
        overview.write("# Fuel App Code Reference\n\n")
        overview.write(
            "This section is generated at build time and includes every PHP file under `fuel/app`.\n\n"
        )

        for group in sorted(grouped_files):
            overview.write(f"## {humanize(group)}\n\n")
            for app_relative, output_path in sorted(grouped_files[group], key=lambda item: item[0].as_posix()):
                page_link = output_path.relative_to(REFERENCE_ROOT).as_posix()
                overview.write(f"- [`{app_relative.as_posix()}`]({page_link})\n")
            overview.write("\n")

    mkdocs_gen_files.set_edit_path(overview_path.as_posix(), "fuel/app")


copy_readme_images()
write_fuel_app_reference()
