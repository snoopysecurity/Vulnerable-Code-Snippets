using System;
using System.IO;
using System.IO.Compression;

namespace myApp
{
    class Program
    {
    static void Main(string[] args)
    {
        string zipPath = "/home/snoopy/extract/evil.zip";
        Console.WriteLine("Enter Path of Zip File to extract:");
        string zipPath = Console.ReadLine();
        Console.WriteLine("Enter Path of Destination Folder");
        string extractPath = Console.ReadLine();

        using (ZipArchive archive = ZipFile.OpenRead(zipPath))
        {
            foreach (ZipArchiveEntry entry in archive.Entries)
            {
 
                    entry.ExtractToFile(Path.Combine(extractPath, entry.FullName));
                    Console.WriteLine(extractPath);
                }
            }
        } 
    }
}

