const path = require("path");
const fs = require("fs").promises;

const pluginRootFile = "plugin_file_name";

const getPluginInfo = async () => {
  try {
    const fileDir = path.join(__dirname, `${pluginRootFile}.php`);
    const content = await fs.readFile(fileDir, "utf8");

    const versionRegex = /Version:\s+([\w.-]+)/;
    const textDomainRegex = /Text Domain:\s+\s*([\w-]+)/;

    const versionMatch = content.match(versionRegex);
    const textDomainMatch = content.match(textDomainRegex);

    const version = versionMatch ? versionMatch[1] : "";
    const textDomain = textDomainMatch ? textDomainMatch[1] : "";

    return { version, textDomain };
  } catch (error) {
    console.error("Error reading file:", error);
    return {};
  }
};

module.exports = { pluginRootFile, getPluginInfo };
